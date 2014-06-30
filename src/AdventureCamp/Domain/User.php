<?php
namespace AdventureCamp\Domain;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
/**
 * Description of User
 *
 * @author gui
 * @ODM\Document(collection="user")
 */
class User {
     /**
     * 
     * @ODM\Id()
     */
    public $id;
    
    /**
     * first name
     * 
     * First name is concatenate with LastName
     * @ODM\Field(type="string")
     */
    public $firstName;

    /**
     * lastname
     * 
     * Lastname is concatenate with FirstName
     * @ODM\Field(type="string")
     */
    public $lastName;

    /**
     * Display Name
     * 
     * Display is used for embbed documents like the name of a comment author
     * @var string
     * @ODM\Field(type="string")
     */
    public $displayName;
    
    /**
     * primary email
     * 
     * Used for authentication, not necessarely the registered email used
     * Recover password and others sensitive mails will use this
     * 
     * @ODM\Field(type="string")
     */
    public $email;
    
    /**
     * Basic authentication password
     * 
     * Password MUST be encrypted
     * 
     * @ODM\Field(type="string")
     */
    public $password;
    
    /**
     * Auth token
     * 
     * @var string $token
     */
    public $token;
    
    /**
     * Auth token expiration date
     * 
     * @var \DateTime $tokenExpires
     */
    public $tokenExpires;
    
    public function setId($id) {
        $this->id = $id;
    }

    public function getId() {
        return new \MongoId($this->id);
    }
    
    public function setFirstName($firstName) {
        $this->firstName = $firstName;
    }

    public function getFirstName() {
        return $this->firstName;
    }

    public function setLastName($lastName) {
        $this->lastName = $lastName;
    }

    public function getLastName() {
        return $this->lastName;
    }

    public function getDisplayName() {
        return $this->displayName;
    }

    public function setDisplayName($displayName) {
        $this->displayName = $displayName;
    }
    
    public function setEmail($email) {
        $this->email = $email;
    }

    public function getEmail() {
        return $this->email;
    }
    
    public function setPassword($password) {
        $this->password = $password;
    }

    public function getPassword() {
        return $this->password;
    }
    
    public function getToken(){
        return $this->token;
    }
    public function setToken($token) {
        $this->token = $token;
    }
    
    public function getTokenExpires(){
        return $this->tokenExpires;
    }
    public function setTokenExpires(\DateTime $tokenExpires) {
        $this->tokenExpires = $tokenExpires;
    }
}
