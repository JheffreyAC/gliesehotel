<?php  
// -- Zona Horaria
date_default_timezone_set('America/Lima');
// --
if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
    $protocol = "https://"; 
} else {
    $protocol = "http://"; 
}
// --
$base_url =  $protocol . $_SERVER['HTTP_HOST'] .  '/gliese/';

// --
define('BASE_URL', $base_url);
define('DEFAULT_CONTROLLER', 'Login');
define('DEFAULT_LAYOUT', 'layout');
// --
define('DB_HOST', '127.0.0.1');
define('DB_USER', 'root');
define('DB_PORT', 3306);
define('DB_PASS', '');
define('DB_NAME', 'db_gliese');