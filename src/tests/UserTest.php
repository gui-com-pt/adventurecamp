<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserTest
 *
 * @author gui
 */
class UserTest extends BaseTest{
    
    /** * @var \AdventureCamp\Data\UserRepository $userRepository */
    protected $userRepository;
    /** * @var \AdventureCamp\Business\UserBusiness $userBusiness */
    protected $userBusiness;
    public function __construct() {
        parent::__construct();
        $this->userRepository = new \AdventureCamp\Data\UserRepository($this->container);
        $this->userBusiness = new \AdventureCamp\Business\UserBusiness($this->container);
    }
    
    public function testCreate(){
        $model = new \AdventureCamp\ServiceModel\RegisterUserModel();
        $model->setFirstName('Luis');
        $model->setLastName('antunes');
        $model->setEmail(\AdventureCamp\Infrastructure\Utils::getHash(12) . '@msn.com');
        $pw = \AdventureCamp\Infrastructure\Utils::getHash(20);
        $model->setPassword($pw);
        $model->setPasswordConfirm($pw);
        $user = $this->userBusiness->register($model);
        
        $userDb = $this->userRepository->get($user->getId());
        
        $this->assertEquals($user->getDisplayName(), $userDb->getDisplayName());
    }
}
