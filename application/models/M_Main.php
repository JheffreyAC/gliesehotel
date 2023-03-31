<?php 
// --
class M_Main extends Model {
    // --
    public function __construct() {
		  parent::__construct();
    }
    
	// --
	public function get_document_types() {
        // --
        try {
            // --
            $sql = 'SELECT id, description, status FROM document_type;';
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

    //--
    public function get_voucher_type() {
        // --
        try {
            // --
            $sql = 'SELECT 
                        id, 
                        description, 
                        status 
                    FROM voucher_type
                    WHERE id IN (1,2);';
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

        //--
        public function get_payment_type() {
            // --
            try {
                // --
                $sql = 'SELECT 
                            id, 
                            description, 
                            status 
                        FROM payment_type;';
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

    // --
	public function get_campus() {
        // --
        try {
            // --
            $sql = 'SELECT id, description, status FROM campus;';
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