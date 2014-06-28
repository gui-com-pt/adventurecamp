<?php
namespace AdventureCamp\ServiceModel;

/**
 * Description of Event
 *
 * @author gui
 */
class Event {
    
    protected $id;
    
    protected $subscriptionsCount;

    protected $when;

    public function getId(){
    	return $this->id;
    }

    public function setId(\MongoId $id) {
    	$this->id = $id;
    }

    public function getSubscriptionsCount(){
    	return $this->subscriptionsCount;
    }
    public function setSubscriptionsCount($count){
    	$this->subscriptionsCount = $count;
    }

    public function getWhen(){
    	return $this->when;
    }
    public function setWhen(\DateTime $date) {
    	$this->when = $date;
    }
}
