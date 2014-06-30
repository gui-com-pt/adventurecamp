<?php

require_once '../bootstrap.php';

$app = \AdventureCamp\Intrastructure\ApplicationProvider::getApp();
$ioc = new \Pimple();
\AdventureCamp\Infrastructure\ContainerFactory::init($ioc);

$app->get('/admin', function() use($ioc, $app) {
    
});

$app->post('/api/subscription', function() use($ioc, $app) {
    $subscriptionBus = new \AdventureCamp\Business\SubscriptionBusiness($ioc);
    $model = new \AdventureCamp\ServiceModel\CreateSubscriptionModel();
    $request = $app->request()->post();

    $result = $subscriptionBus->create($model);
    $response = array(
        'subscription' => $result
    );
    echo json_encode($response);
});



$app->get('/api/subscription', function() use($ioc, $app) {

    $model = new \AdventureCamp\ServiceModel\FindSubscriptionModel();
    $subscriptionBus = new \AdventureCamp\Business\SubscriptionBusiness($ioc);

    $take = is_numeric($app->request()->params('take')) ? $app->request()->params('take') : 100;
    $model->setTake($take);
    $skip = is_numeric($app->request()->params('skip')) ? $app->request()->params('skip') : 0;
    $model->setSkip($skip);

    $results = $subscriptionBus->find($model);
    $response = array(
        'subscriptions' => $results
    );
    echo json_encode($response);
});

$app->get('/api/subscription/:id', function($id) use($ioc, $app) {
    $model = new \AdventureCamp\ServiceModel\FindSubscriptionModel();
    $subscriptionBus = new \AdventureCamp\Business\SubscriptionBusiness($ioc);

    $result = $subscriptionBus->get(new \MongoId($id));
    $response = array(
        'subscription' => $result
    );
    echo json_encode($response);
});

$app->run();
