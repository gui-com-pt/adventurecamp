<?php
$a = dirname(__FILE__) . '/../' . PATH_SEPARATOR . get_include_path();
$b = dirname(__FILE__) . PATH_SEPARATOR . get_include_path();
set_include_path($b);
spl_autoload_register();
require_once '../bootstrap.php';

$config = include('local-settings.php');
$app = \AdventureCamp\Infrastructure\ApplicationProvider::getApp();
$ioc = new \Pimple();
\AdventureCamp\Infrastructure\ContainerFactory::init($ioc, $config);

$app->get('/gui-ugly-code-for-setting-up-adventurecamp-2014-website', function() use($ioc) {
   $user = new \AdventureCamp\Domain\User();
   $user->setPassword(md5('123123'));
   $user->setFirstName('Guilherme');
   $user->setLastName('Cardoso');
   $user->setEmail('email@guilhermecardoso.pt');
   $ioc['dm']->persist($user);
   $ioc['dm']->flush();
   echo json_encode($user);
});

$app->post('/api/subscription', function() use($ioc, $app) {
    $subscriptionBus = new \AdventureCamp\Business\SubscriptionBusiness($ioc);
    $model = new \AdventureCamp\ServiceModel\CreateSubscriptionModel();
    
    $userId = new \MongoId("53b1f2eba25b8efa1e8b4567");
    $eventId = new \MongoId("53b1f2eba25b8efa1e8b4567");
    $request = json_decode($app->environment['slim.input']);
    $model->setEventId($eventId);
    $model->setName($request->name);
    $model->setBi($request->bi);
    $model->setBirthday(new \DateTime($request->birthday));
    $model->setEmail($request->email);
    $model->setAddress($request->address);
    $model->setCep($request->cep);
    $model->setContact($request->contact);
    $model->setObservations(property_exists($request, 'observations') ? $request->observations : 'N/D');
    $result = $subscriptionBus->create($userId, $model);
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

$app->get(".*", function() {
  include('app.php');
});
$app->post(".*", function() {
  include('app.php');
});
$app->run();
