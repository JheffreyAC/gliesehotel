<?php 
// --
class M_Income extends Model {
    // --
    public function __construct() {
		parent::__construct();
    }
    
    // --
	public function get_income() {
        // --
        try {
            // --
                $sql = 'SELECT 
                        p.id AS id_income,
                        p.id_category,
                        c.description AS category,
                        p.description,
                        p.stock,
                        p.code,
                        p.status
                    FROM income p
                    INNER JOIN categories c ON c.id = p.id_category
                WHERE p.status = 1';
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
	public function get_income_by_id($bind) {
        // --
        try {
            // --
            $sql = 'SELECT 
                    p.id AS id_income,
                    p.id_category,
                    c.description AS category,
                    p.description,
                    p.stock,
                    p.code,
                    p.status
                FROM income p
                INNER JOIN categories c ON c.id = p.id_category
                WHERE p.id = :id_income AND p.status = 1';
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
    public function create_income($bind) {
        // --
        try {
            // --
            $sql = 'INSERT INTO income 
            (
                id_category, 
                description,
                stock,
                code
            ) 
            VALUES 
            (
                :id_category,
                :description,
                :stock,
                :code     
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
     public function update_income($bind) {
        // --
        try {
            // --
            $sql = 'UPDATE income 
                SET
                    id_category = :id_category,
                    description = :description,
                    stock = :stock,
                    code = :code
            WHERE id = :id_income';
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
    public function delete_income($bind) {
        // --
        try {
            // --
            $sql = 'DELETE FROM income 
            where id = :id_income';
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