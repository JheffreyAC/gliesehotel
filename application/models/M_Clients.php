<?php 
// --
class M_Clients extends Model {
    // --
    public function __construct() {
		parent::__construct();
    }
    
    // --
	public function get_clients() {
        // --
        try {
            // --
            $sql = 'SELECT 
                    c.id AS id_clients,
                    c.id_document_type,
                    dt.description AS document_type,
                    c.name,
                    c.document_number,
                    c.address,
                    c.phone,
                    c.business_name,
                    c.email,
                    c.status
                FROM clients c
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
    public function get_client_by_id($bind) {
        // --
        try {
            // --
            $sql = 'SELECT 
                    c.id AS id_clients,
                    c.id_document_type,
                    dt.description AS document_type,
                    c.name,
                    c.document_number,
                    c.address,
                    c.phone,
                    c.business_name,
                    c.email,
                    c.status
                FROM clients c
                INNER JOIN document_type dt ON dt.id = c.id_document_type
                WHERE c.status = 1';
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
    public function create_clients($bind) {
        // --
        try {
            // --
            $sql = 'INSERT INTO clients
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
    public function update_clients($bind) {
        // --
        try {
            // --
            $sql = 'UPDATE clients 
                SET
                    id_document_type = :id_document_type,
                    name = :name,
                    document_number = :document_number,
                    address = :address,
                    phone = :phone,
                    email = :email,
                    business_name = :business_name
                WHERE id = :id_clients';
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
    public function delete_clients($bind) {
        // --
        try {
            // --
            $sql = 'DELETE FROM clients 
            where id = :id_clients';
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