<?php
namespace AdventureCamp\Domain;

/**
 * Description of Event
 *
 * @author gui
 */
class Event {
    
    /**
     * @ODM\Id
     */
    protected $id;
    

    /**
     * @ODM\Field(type="numeric")
     */
    protected $subscriptionsCount;

    /**
     * @ODM\Field(type="date")
     */
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
