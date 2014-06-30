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
       
       $subscriptionDb = $this->subscriptionRepository->get($subscription->getId());
       
       $this->assertEquals($subscription->getName(), $subscriptionDb->getName());
   }
}
