<?php

namespace AdventureCamp\Infrastructure;

use Doctrine\MongoDB\Connection;
use Doctrine\ODM\MongoDB\Configuration;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\Mapping\Driver\AnnotationDriver;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ContainerFactory
 *
 * @author gui
 */
class ContainerFactory {

    /**
     * Register dependencies in IOC
     * 
     * @param \Pimple $ioc
     * @return \Pimple
     */
    public static function init(\Pimple &$ioc, $localSettings = array()) {

$defaultSettings = array(
    'smtp.hostname' => 'localhost',
    'smtp.port' => 25,
    'smtp.authenticate' => false,
    'smtp.security' => null,
    'smtp.username' => null,
    'smtp.password' => null
);
$configs = array_replace($defaultSettings, $localSettings);
        $ioc['config'] = function() use($configs){
            return $configs;
        };
        $ioc['dm'] = function($c) {

            AnnotationDriver::registerAnnotationClasses();

            //$client = new \MongoClient('localhost', array('db' => 'jobs' , 'username' => 'guilherme', 'password' => 'dumbpw'));
            $connection = new Connection();
            $config = new Configuration();
            $config->setProxyDir(__DIR__ . '/Proxies');
            $config->setProxyNamespace('Proxies');
            $config->setHydratorDir(__DIR__ . '/Hydrators');
            $config->setHydratorNamespace('Hydrators');
            $config->setAutoGenerateProxyClasses(true);
            $config->setAutoGenerateHydratorClasses(true);
            $config->setDefaultDB('aa2014');
            $config->setMetadataDriverImpl(AnnotationDriver::create('AdventureCamp/Domain'));

            $dm = DocumentManager::create($connection, $config);
            return $dm;
        };
        return $ioc;
    }

}
