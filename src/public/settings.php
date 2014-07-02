<?php
/* 
 * .gitignore is ignoring local-settings.php
 * Set the settings by creating local-settings.php similar to this file, returning a array
 */
$configLocal = array(
    'smtp.host' => 'localhost',
    'smtp.port' => 25,
    'smtp.authenticate' => true,
    'smtp.security' => null
    'smtp.username' => null,
    'smtp.password' => null
);

return $configLocal;