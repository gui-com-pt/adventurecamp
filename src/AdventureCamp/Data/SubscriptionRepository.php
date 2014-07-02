<?php

namespace AdventureCamp\Data;

class SubscriptionRepository {
    
	/**     * @var type \DocumentMannager  */
	protected $dm;

	const MONGO_SUBSCRIPTION = 'AdventureCamp\Domain\Subscription';
        
        const MONGO_SUBSCRIPTION_INFO = 'AdventureCamp\Domain\SubscriptionInfo';

	public function __construct(\Pimple $ioc) {
		$this->dm = $ioc['dm'];
	}

	public function create(\MongoId $userId, \AdventureCamp\ServiceModel\CreateSubscriptionModel $model) {
		$entity = new \AdventureCamp\Domain\Subscription();
		$entity->setEventId($model->getEventId());
		$entity->setName($model->getName());
		$entity->setBirthday($model->getBirthday());
		$entity->setEmail($model->getEmail());
		$entity->setBi($model->getBi());
		$entity->setAddress($model->getAddress());
		$entity->setCep($model->getCep());
		$entity->setObservations($model->getObservations());
		$entity->setState((int)\AdventureCamp\ServiceModel\SubscriptionState::Created);
		$entity->setContact($model->getContact());
		$this->dm->persist($entity);
		return $entity;
	}

	public function confirm(\MongoId $subscriptionId) {
		$this->dm->createQueryBuilder(self::MONGO_SUBSCRIPTION)
		->update()
		->field('_id')->equals($subscriptionId)
		->field('state')->set((int)\AdventureCamp\ServiceModel\SubscriptionState::Confirmed)
		->getQuery()
		->execute();
	}
        /**
         * Get a Subscription entity by id
         * 
         * @param \MongoId $userId
         * @return \AdventureCamp\Domain\Subscription
         */
        public function get(\MongoId $userId) {
            $entity = $this->dm->createQueryBuilder(self::MONGO_SUBSCRIPTION)
                    ->field('_id')->equals($userId)
                    ->getQuery()
                    ->getSingleResult();
            return $entity;
        }

	public function find(\AdventureCamp\ServiceModel\FindSubscriptionModel $model) {
		$query = $this->dm->createQueryBuilder(self::MONGO_SUBSCRIPTION_INFO);

		if(is_numeric($model->getSkip())) {
			$query->skip($model->getSkip());
		}

		if(is_numeric($model->getTake())) {
			$query->limit($model->getTake());
		}

		if(!is_null($model->getEventId())) {
			$query->field('eventId')->equals($model->getEventId());
		}

		if(is_numeric($model->getState())) {
			$query->field('state')->equals($model->getState());
		}
                
                $arr = $query->select('_id', 'name', 'birthday', 'email')
                        ->getQuery()
                        ->execute()
                        ->toArray();
                
                return array_values($arr);
	}
}