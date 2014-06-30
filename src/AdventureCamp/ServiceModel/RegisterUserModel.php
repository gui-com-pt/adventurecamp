<?php
namespace AdventureCamp\ServiceModel;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RegisterUserModel
 *
 * @author gui
 */
class RegisterUserModel {
    
    protected $firstName;
    
    protected $lastName;
    
    protected $email;
    
    protected $password;
    
    protected $passwordConfirm;
    
    public function getFirstName() {
        return $this->firstName;
    }
    public function setFirstName($firstName) {
        $this->firstName = $firstName;
    }
    
    public function getLastName(){
        return $this->lastName;
    }
    public function setLastName($lastName) {
        $this->lastName = $lastName;
    }
    
    public function getEmail(){
        return $this->email;
    }
    public function setEmail($email) {
        $this->email = $email;
    }
    
    public function getPassword(){
        return $this->password;
    }
    public function setPassword($password) {
        $this->password = $password;
    }
    
    public function getPasswordConfirm(){
        return $this->passwordConfirm;
    }
    public function setPasswordConfirm($password) {
        $this->password = $password;
    }
}
