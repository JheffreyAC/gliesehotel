<?php 
// --
class M_Income extends Model {
    // --
    public function __construct() {
		parent::__construct();
    }
    
    // -- 
    public function get_series() {
      // --
      try {
            // --
            $sql = 'SELECT 
                    proof_series,
                    voucher_series
                FROM income
                LIMIT 1
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