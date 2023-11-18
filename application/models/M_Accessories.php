<?php 
// --
class M_Accessories extends Model {
    // --
    public function __construct() {
		parent::__construct();
    }
    public function get_accessories() {
      // --
      try {
          // --
              $sql = 'SELECT 
                      id_accessory,
                      accessory_description,
                      accessory_price,
                      accessory_stock
                    
                      
                  FROM accessory
                  
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

