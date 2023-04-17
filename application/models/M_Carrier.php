<?php 
// --
class M_Carrier extends Model {
    // --
    public function __construct() {
		parent::__construct();
    }

      // --
    public function get_carrier() {
      // --
      try {
          // --
              $sql = 'SELECT 
                      c.id AS id_carrier,
                      c.id_document_type,
                      dt.description AS document_type,
                      c.name,
                      c.document_number,
                      c.address,
                      c.phone,
                      c.business_name,
                      c.email,
                      c.status
                  FROM carrier c
                  INNER JOIN document_type dt ON dt.id = c.id_document_type
                  WHERE c.status = 1';
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
    public function get_carrier_by_id($bind) {
        // --
        try {
            // --
            $sql = 'SELECT 
                    c.id AS id_carrier,
                    c.id_document_type,
                    dt.description AS document_type,
                    c.name,
                    c.document_number,
                    c.address,
                    c.phone,
                    c.business_name,
                    c.email,
                    c.status
                FROM carrier c
                INNER JOIN document_type dt ON dt.id = c.id_document_type
                WHERE c.id = :id_carrier AND c.status = 1';
            // --
            $result = $this->pdo->fetchOne($sql, $bind);
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
    public function create_carrier($bind) {
        // --
        try {
            // --
            $sql = 'INSERT INTO carrier
            (
                id_document_type,
                name,
                document_number,
                address,
                phone,
                business_name,
                email
            ) 
            VALUES 
            (
                :id_document_type,
                :name,
                :document_number,
                :address,
                :phone,
                :business_name,
                :email   
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

    // --
    public function update_carrier($bind) {
        // --
        try {
            // --
            $sql = 'UPDATE carrier 
                SET
                    id_document_type = :id_document_type,
                    name = :name,
                    document_number = :document_number,
                    address = :address,
                    phone = :phone,
                    business_name = :business_name,
                    email = :email
                WHERE id = :id_carrier';
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

    // --
    public function delete_carrier($bind) {
        // --
        try {
            // --
            $sql = 'DELETE FROM carrier 
            where id = :id_carrier';
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

    // --
    public function get_business_name() {
        // --
        try {
            // --
            $sql = 'SELECT 
                    id,
                    business_name,
                    status
                FROM carrier';
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