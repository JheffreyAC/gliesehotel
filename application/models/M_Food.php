<?php 
// --
class M_Food extends Model {
    // --
    public function __construct() {
		parent::__construct();
    }
    public function get_food() {
      // --
      try {
          // --
              $sql = 'SELECT 
                      id_food,
                      food_description,
                      food_price,
                      food_stock,
                      tipo_food
                    
                      
                  FROM food
                  
           ';
          // --
          $result = $this->pdo->fetchAll($sql);
          // --
          if ($result) {
              // --
              $response = array('status' => 'OK', 'result' => $result);
          } else {
              // --
              $response = array('status' => 'ERROR', 'result' => array());
          }
      } catch (PDOException $e) {
          // --
          $response = array('status' => 'EXCEPTION', 'result' => $e);
      }
      // --
      return $response;
    }
}

