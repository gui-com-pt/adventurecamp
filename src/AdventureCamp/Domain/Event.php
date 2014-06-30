<?php
namespace AdventureCamp\Domain;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/**
 * Description of Event
 *
 * @author gui
 * @ODM\Document(collection="event")
 */
class Event implements \JsonSerializable {
    
    /**
     * @ODM\Id
     * @var \MongoId
     */
    protected $id;
    
    /**
     * @ODM\Field(type="string")
     * @var string
     */
    protected $name;
    

    /**
     * @ODM\Field(type="numeric")
     */
    protected $subscriptionsCount;

    /**
     * @ODM\Field(type="date")
     */
    protected $when;

    public function jsonSerialize() {
        $vars = $this;
        return get_object_vars($vars);
    }
    
    public function getId(){
    	return $this->id;
    }

    public function setId(\MongoId $id) {
    	$this->id = $id;
    }
    
    public function getName(){
        return $this->name;
    }
    public function setName($name) {
        $this->name = $name;
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
