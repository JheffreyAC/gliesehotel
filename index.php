<?php
// -- Jeremi Gonzales mi bb and Ruben Dario
error_reporting(E_ALL);
ini_set('display_errors', '1');
// --
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', realpath(dirname(__FILE__)) . DS);
define('APP_PATH', ROOT . 'application' . DS);
define('APP_VENDOR', ROOT . 'vendor' . DS);

// --
require_once APP_PATH . 'config' . DS . 'Config.php';
require_once APP_PATH . 'core' . DS . 'Autoload.php';

// --
try {
    // --
    Bootstrap::run(new Request);
} catch (Exception $e) {
    echo $e->getMessage();
}
