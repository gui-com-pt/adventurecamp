<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BaseTest
 *
 * @author gui
 */
class BaseTest extends PHPUnit_Framework_TestCase {

    /**     * @var \Pimple $container Ioc container */
    public $container;

    /**     * @var \Slim\Slim $app Slim application */
    public $app;

    /**     * @var \Doctrine\ODM\MongoDB\DocumentManager $dm Doctrine Document Mannager */
    public $dm;

    public function __construct() {
        parent::__construct();
        $ioc = new \Pimple();
        \AdventureCamp\Infrastructure\ContainerFactory::init($ioc);
        $this->container  = $ioc;
        $this->dm = $this->container['dm'];
        $this->app = \AdventureCamp\Infrastructure\ApplicationProvider::getApp();
    }

}
