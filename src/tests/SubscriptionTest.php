<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SubscriptionTest
 *
 * @author gui
 */
class SubscriptionTest extends BaseTest {
    
    /** * @var \MongoId $eventId Event generated for subscription tests */
    protected $eventId;
    /** * @var \AdventureCamp\Business\SubscriptionBusiness $subscriptionBusiness */
    protected $subscriptionBusiness;
    /** * @var \AdventureCamp\Data\SubscriptionRepository $subscriptionRepository */
    protected $subscriptionRepository;
    
   public function __construct() {
       parent::__construct();
       $this->subscriptionBusiness = new \AdventureCamp\Business\SubscriptionBusiness($this->container);
       $this->subscriptionRepository = new \AdventureCamp\Data\SubscriptionRepository($this->container);
       $event = new \AdventureCamp\Domain\Event();
       $when = new \DateTime();
       $when->add(new \DateInterval('PT1H'));
       $event->setWhen($when);
       $event->setName('Volta ao Mundo em 6 dias');
       $this->dm->persist($event);
       $this->dm->flush($event);
       $this->eventId = new \MongoId($event->getId());
   }
   
   public function testConfirmSubscription(){
       $id = $this->getSubscriptionId();
       $this->subscriptionBusiness->confirm($id);
       
       $subscription = $this->subscriptionRepository->get($id);
       $this->dm->refresh($subscription);
       $this->assertEquals((int)$subscription->getState(), (int) \AdventureCamp\ServiceModel\SubscriptionState::Confirmed);
   }
   
   public function testCreateSubscription(){
       $model = new \AdventureCamp\ServiceModel\CreateSubscriptionModel();
       $model->setEventId($this->eventId);
       $model->setName('Carlos Guilherme Magalhães Cardoso');
       $model->setAddress('Viseu, linda cidade museu');
       $model->setBi('007 007 007');
       $birthday = new DateTime();
       $birthday->modify('-12 year');
       $model->setBirthday($birthday);
       $model->setCep('3500');
       $model->setEmail('email@gui.pt');
       $model->setObservations('Eu sou alérgico!');
       
       $userId = new \MongoId("53b1f2eba25b8efa1e8b4567");
       
       $subscription = $this->subscriptionBusiness->create($userId, $model);
       
       $subscriptionDb = $this->subscriptionRepository->get(new \MongoId($subscription->getId()));
       
       $this->assertEquals($subscription->getName(), $subscriptionDb->getName());
   }
   
   /**
    * Create a new subscription and return his id
    * @return \MongoId
    */
   private function getSubscriptionId(){
       $entity = new \AdventureCamp\Domain\Subscription();
       $entity->setEventId($this->eventId);
       $entity->setName('Carlos Guilherme Magalhães Cardoso');
       $entity->setAddress('Viseu, linda cidade museu');
       $entity->setBi('007 007 007');
       $birthday = new DateTime();
       $birthday->modify('-12 year');
       $entity->setBirthday($birthday);
       $entity->setCep('3500');
       $entity->setEmail('email@gui.pt');
       $entity->setObservations('Eu sou alérgico!');
       $entity->setState((int) \AdventureCamp\ServiceModel\SubscriptionState::Created);
       $this->dm->persist($entity);
       $this->dm->flush();
       return new \MongoId($entity->getId());
   }
}
