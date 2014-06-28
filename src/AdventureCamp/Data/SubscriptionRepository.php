<?

namespace AdventureCamp\Data;

class SubscriptionRepository {
	
	protected $dm;

	const MONGO_SUBSCRIPTION = 'AdventureCamp\Domain\Subscription';

	public function __construct(\Pimple $ioc) {
		$this->dm = $ioc;
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
		$entity->setState(\AdventureCamp\ServiceModel\SubscriptionState::Created);
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

	public function find(\AdventureCamp\ServiceModel\FindSubscriptionModel $model) {
		$query = $this->dm->createQueryBuilder(self::MONGO_SUBSCRIPTION);

		if(is_numeric($model->getSkip)) {
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
	}
}