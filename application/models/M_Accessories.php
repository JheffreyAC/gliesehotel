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
                      id_accesory,
                      accesory_description,
                      accesory_price,
                      accesory_stock
                    
                      
                  FROM accesory
                  
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
    public function create_accessories($bind) {
        // --
        try {
            // --
            $sql = 'INSERT INTO accesory
            (
                
                accesory_description,
                accesory_price,
                accesory_stock
            ) 
            VALUES 
            (
                
                :accesory_description,
                :accesory_price,
                :accesory_stock    
            )';
            // --
            $result = $this->pdo->perform($sql, $bind);
            // --
            if ($result) {
                // --
                $response = array('status' => 'OK', 'result' => array());
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

