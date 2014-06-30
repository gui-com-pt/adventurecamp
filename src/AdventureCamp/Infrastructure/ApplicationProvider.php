<?php
namespace AdventureCamp\Infrastructure;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ApplicationProvider
 *
 * @author gui
 */
class ApplicationProvider {
    
    public static function getApp(){
        
        $app = new \Slim\Slim(array(
            'mode' => 'development'
        ));
        
        return $app;
    }
}
