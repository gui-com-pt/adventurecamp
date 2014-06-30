<?php
namespace AdventureCamp\Data;


/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserRepository
 *
 * @author gui
 */
class UserRepository {
    
    /** * \Doctrine\ODM\MongoDB\DocumentManager $dm */
    protected $dm;
    const MONGO_USER = 'AdventureCamp\Domain\User';
    
    public function __construct(\Pimple $ioc) {
            $this->dm = $ioc['dm'];
    }
    
   public function create(\AdventureCamp\Domain\User $entity) {
       $this->dm->persist($entity);
       $this->dm->flush();
       return $entity;
   }
   
   public function authenticate($email, $passwordEncrypted) {
       $q = $this->dm->createQueryBuilder(self::MONGO_USER)
               ->select('_id')
               ->field('email')->equals($email)
               ->field('password')->equals($passwordEncrypted)
               ->getQuery()
               ->getSingleResult();
       return is_null($q) ? false : true;
   }
   
   public function setAuth(\MongoId $userId, $authToken, $authExpires) {
       $this->dm->createQueryBuilder(self::MONGO_USER)
               ->update()
               ->field('_id')->equals($userId)
               ->field('token')->set($authToken)
               ->field('tokenExpires')->set($authExpires)
               ->getQuery()
               ->execute();
   }
   
   /**
    * 
    * @param \MongoId $userId
    * @return \AdventureCamp\Domain\User
    */
   public function get(\MongoId $userId) {
       return $this->dm->createQueryBuilder(self::MONGO_USER)
               ->field('_id')->equals($userId)
               ->getQuery()
               ->getSingleResult();
   }
}
