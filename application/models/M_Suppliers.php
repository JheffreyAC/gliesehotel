<?php 
// --
class M_Suppliers extends Model {
    // --
    public function __construct() {
		parent::__construct();
    }
    
    // --
	public function get_suppliers() {
        // --
        try {
            // --
                $sql = 'SELECT 
                        s.id AS id_supplier,
                        s.id_document_type,
                        dt.description AS document_type,
                        s.name,
                        s.document_number,
                        s.address,
                        s.phone,
                        s.business_name,
                        s.email,
                        s.status
                    FROM supplier s
                    INNER JOIN document_type dt ON dt.id = s.id_document_type
                    WHERE s.status = 1';
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
	public function get_supplier_by_id($bind) {
        // --
        try {
            // --
            $sql = 'SELECT 
                    s.id AS id_supplier,
                    s.id_document_type,
                    dt.description AS document_type,
                    s.name,
                    s.document_number,
                    s.address,
                    s.phone,
                    s.business_name,
                    s.email,
                    s.status
                FROM supplier s
                INNER JOIN document_type dt ON dt.id = s.id_document_type
                WHERE s.id = :id_supplier AND s.status = 1';
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
    public function create_supplier($bind) {
        // --
        try {
            // --
            $sql = 'INSERT INTO supplier
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
     public function update_supplier($bind) {
        // --
        try {
            // --
            $sql = 'UPDATE supplier 
                SET
                    id_document_type = :id_document_type,
                    name = :name,
                    document_number = :document_number,
                    address = :address,
                    phone = :phone,
                    business_name = :business_name,
                    email = :email
                WHERE id = :id_supplier';
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
    public function delete_supplier($bind) {
        // --
        try {
            // --
            $sql = 'DELETE FROM supplier 
            where id = :id_supplier';
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