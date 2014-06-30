<?php
namespace AdventureCamp\Business;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserBusiness
 *
 * @author gui
 */
class UserBusiness {
    
    /** * @var \AdventureCamp\Data\UserRepository $userRepository */
    protected $userRepository;
    
    /** * @var \Doctrine\ODM\MongoDB\DocumentMannager $dm */
    protected $dm;
    
    public function __construct(\Pimple $ioc) {
        $this->userRepository = new \AdventureCamp\Data\UserRepository($ioc);
        $this->dm = $ioc['dm'];
    }
    
    /**
     * 
     * @param \AdventureCamp\ServiceModel\RegisterUserModel $model
     * @return \AdventureCamp\Domain\User
     */
    public function register(\AdventureCamp\ServiceModel\RegisterUserModel $model) {
        $user = new \AdventureCamp\Domain\User();
        $user->setFirstName($model->getFirstName());
        $user->setLastName($model->getLastName());
        $displayName = $model->getFirstName() . ' ' . $model->getLastName();
        $user->setDisplayName($displayName);
        $user->setPassword(md5($model->getPassword()));
        $user->setEmail($model->getEmail());
        
        $this->userRepository->create($user);
        
        $this->dm->flush();
        
        return $user;
    }
    
    /**
     * 
     * @param \MongoId $userId
     * @return \AdventureCamp\Domain\User
     */
    public function get(\MongoId $userId) {
        return $this->userRepository->get($userId);
    }
}
