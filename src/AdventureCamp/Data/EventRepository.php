<?
namespace Volupio\Data;

class EventRepository {

	protected $dm;
	const MONGO_EVENT = 'AdventureCamp\Domain\Event';

	public function __construct(\Pimple $ioc) {
		$this->dm = $ioc['dm'];
	}

	public function create(\AdventureCamp\ServiceModel\CreateEventModel $model) {
		$entity = new \AdventureCamp\Domain\Event();
		$entity->setName($model->getName());
		$entity->setWhen($model->getWhen());
		$entity->setSubscriptionsCount(0);

		$this->dm->persist($entity);
		return $entity;
	}
}