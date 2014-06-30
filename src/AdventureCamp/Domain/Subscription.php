<?php
namespace AdventureCamp\Domain;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/**
 * @ODM\Document(collection="subscription")
 */
class Subscription implements \JsonSerializable {
    /**
     * @ODM\Id
     */
    protected $id;

    /**
     * @ODM\Field(type="object_id")
     */
    protected $eventId;
    
    /**
     * @ODM\Field(type="string")
     */
    protected $name;
    
    /**
     * @ODM\Field(type="date")
     */
    protected $birthday;
    
    /**
     * @ODM\Field(type="string")
     */
    protected $email;

    /**
     * @ODM\Field(type="string")
     */
    protected $bi;

    /**
     * @ODM\Field(type="string")
     */
    protected $address;

    /**
     * @ODM\Field(type="string")
     */
    protected $cep;

    /**
     * @ODM\Field(type="string")
     */
    protected $observations;
    
    /**
     * @ODM\Field
     */
    protected $state;
    
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

    public function getEventId(){
        return $this->eventId;
    }
    public function setEventId(\MongoId $id) {
        $this->eventId = $id;
    }
    
    public function getName() {
        return $this->name;
    }
    public function setName($name) {
        $this->name = $name;
    }

    public function getBi(){
        return $this->bi;
    }
    public function setBi($bi) {
        $this->bi = $bi;
    }

    public function getBirthday(){
        return $this->birthday;
    }
    public function setBirthday($date) {
        $this->birthday = $date;
    }

    public function getEmail(){
        return $this->email;
    }
    public function setEmail($email) {
        $this->email = $email;
    }

    public function getAddress(){
        return $this->address;
    }
    public function setAddress($address) {
        $this->address = $address;
    }

    public function getCep(){
        return $this->cep;
    }
    public function setCep($cep) {
        $this->cep = $cep;
    }

    public function getObservations(){
        return $this->observations;
    }
    public function setObservations($observations) {
        $this->observations = $observations;
    }
    
    public function getState() {
        return $this->state;
    }
    public function setState($state) {
        $this->state = $state;
    }
}