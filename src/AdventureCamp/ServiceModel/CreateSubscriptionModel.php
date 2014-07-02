<?php

namespace AdventureCamp\ServiceModel;

class CreateSubscriptionModel {
	
    protected $eventId;

    protected $name;
    
    protected $birthday;
    
    protected $email;

    protected $bi;

    protected $address;

    protected $cep;

    protected $observations;

    protected $contact;

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
    public function setBirthday(\DateTime $date) {
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

    public function getContact(){
        return $this->contact;
    }
    public function setContact($contact) {
        $this->contact = $contact;
    }
}