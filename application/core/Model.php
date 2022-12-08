<?php 
// -- Libraries
require APP_VENDOR . 'autoload.php';
use Aura\Sql\ExtendedPdo;

// -- Class Model
class Model {
    // --
    protected $pdo;
    // --
    public function __construct() {
        // -- http://auraphp.com/framework/1.x/de/sql/
        $this->pdo = new ExtendedPdo(
                    'mysql:host='.DB_HOST. 
                    ';port='.DB_PORT . 
                    ';dbname='.DB_NAME. 
                    ';charset=utf8',
                    DB_USER,
                    DB_PASS,
                    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'")
        );
    }
}