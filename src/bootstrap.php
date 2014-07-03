<?php
date_default_timezone_set('UTC');

$vendorDir = __DIR__ . '/vendor/';
require $vendorDir . 'autoload.php';

if (session_id() == '' || !isset($_SESSION)) {
    // session isn't started
    session_start();
}

/**
 * Auto Loaders
 */
\Slim\Slim::registerAutoloader();

/**
 * PSR-0 Autoloading implementation
 */
function autoload($className) {
    $className = ltrim($className, '\\');
    $fileName = '';
    $namespace = '';
    if ($lastNsPos = strrpos($className, '\\')) {
        $namespace = substr($className, 0, $lastNsPos);
        $className = substr($className, $lastNsPos + 1);
        $fileName = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
    }
    $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';

    require $fileName;
}

spl_autoload_extensions('.php');
spl_autoload_register('autoload');


$language = 'pt_PT.UTF8';
putenv('LANG=' . $language);
putenv('LANGUAGES=' . $language);
setlocale(LC_ALL, $language);