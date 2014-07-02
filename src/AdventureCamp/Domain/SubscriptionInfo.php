<?php
namespace AdventureCamp\Domain;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SubscriptionInfo
 *
 * @author gui
 * @ODM\Document(collection="subscription")
 * @ODM\HasLifecycleCallbacks
 */
class SubscriptionInfo implements \JsonSerializable {
    
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
     * @ODM\Field(type="date")
     * @var \DateTime
     */
    protected $birthday;
    
    /**
     * @var string
     */
    protected $when;
    
    /**
     * @var string
     * @ODM\Field(type="string")
     */
    protected $email;
    /**
     * 
     * @ODM\Preload
     */
    public function preLoad(array &$data) {
        $dateTime = new \DateTime('@' . $data['birthday']->sec);
        $dateTime->setTimezone(new \DateTimeZone(date_default_timezone_get()));
        $data['birthday'] = $dateTime->format('y-m-d');
    }
    
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
    
    public function getBirthday(){
        return $this->birthday;
    }
    public function setBirthday(\DateTime $date) {
        $this->birthday = $date;
    }
    
    public function getEmail(){
        return $this->email;
    }
    public function setEmail($email) {
        $this->email = $email;
    }
}
