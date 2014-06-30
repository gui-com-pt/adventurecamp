<?php

namespace AdventureCamp\ServiceModel;

class FindSubscriptionModel {
	
	protected $skip;

	protected $take;

	protected $eventId;

	protected $state;

	public function getSkip(){
		return $this->skip;
	}

	public function setSkip($skip) {
		$this->skip = $skip;
	}

	public function getTake() {
		return $this->take;
	}
	public function setTake($take) {
		$this->take = $take;
	}

	public function getEventId() {
		return $this->eventId;
	}
	public function setEventId(\MongoId $id) {
		$this->eventId = $id;
	}

	public function getState() {
		return $this->state;
	}
	public function setState($state) {
		$this->state = $state;
	}
}