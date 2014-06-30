<?php


$a = dirname(__FILE__) . '/../' . PATH_SEPARATOR . get_include_path();
$b = dirname(__FILE__) . PATH_SEPARATOR . get_include_path();
set_include_path($b);
spl_autoload_register();
require_once '../bootstrap.php';
require_once 'BaseTest.php';