<?php
namespace AdventureCamp\Business;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SubscriptionBusiness
 *
 * @author gui
 */
class SubscriptionBusiness {
    
    /** * @var \AdventureCamp\Data\SubscriptionRepository */
    protected $subscriptionRepository;
    
    public function __construct(\Pimple $ioc) {
        $this->subscriptionRepository = new \AdventureCamp\Data\SubscriptionRepository($ioc);
    }
    
    /**
     * 
     * @param \MongoId $id
     * @return \AdventureCamp\Domain\Subscription
     */
    public function get(\MongoId $id) {
        $result = $this->subscriptionRepository->get($id);
        return $result;
    }
    
    /**
     * 
     * @param \AdventureCamp\ServiceModel\FindSubscriptionModel $model
     * @return \AdventureCamp\Domain\SubscriptionInfo
     */
    public function find(\AdventureCamp\ServiceModel\FindSubscriptionModel $model){
        $results = $this->subscriptionRepository->find($model);
        return $results;
    }
    
    /**
     * 
     * @param \AdventureCamp\ServiceModel\CreateSubscriptionModel $model
     * @return \AdventureCamp\Domain\Subscription
     */
    public function create(\MongoId $userId, \AdventureCamp\ServiceModel\CreateSubscriptionModel $model) {
        $result = $this->subscriptionRepository->create($userId, $model);
        return $result;
    }
    
    public function confirm(\MongoId $subscriptionId) {
        $this->subscriptionRepository->confirm($subscriptionId);
    }
}
