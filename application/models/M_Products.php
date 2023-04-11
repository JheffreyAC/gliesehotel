<?php 
// --
class M_Products extends Model {
    // --
    public function __construct() {
		parent::__construct();
    }
    
    // --
	public function get_products() {
        // --
        try {
            // --
                $sql = 'SELECT 
                        p.id AS id_product,
                        p.id_category,
                        c.description AS category,
                        p.description,
                        p.stock,
                        p.code,
                        p.status,
                        p.ts_start
                    FROM products p
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
	public function get_product_by_id($bind) {
        // --
        try {
            // --
            $sql = 'SELECT 
                    p.id AS id_product,
                    p.id_category,
                    c.description AS category,
                    p.description,
                    p.stock,
                    p.code,
                    p.status,
                    p.ts_start
                FROM products p
                INNER JOIN categories c ON c.id = p.id_category
                WHERE p.id = :id_product AND p.status = 1';
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
    public function create_product($bind) {
        // --
        try {
            // --
            $sql = 'INSERT INTO products 
            (
                id_category, 
                description,
                stock,
                code,
                ts_start
            ) 
            VALUES 
            (
                :id_category,
                :description,
                :stock,
                :code,
                :ts_start     
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
     public function update_product($bind) {
        // --
        try {
            // --
            $sql = 'UPDATE products 
                SET
                    id_category = :id_category,
                    description = :description,
                    stock = :stock,
                    code = :code,
                    ts_start = :ts_start
            WHERE id = :id_product';
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
    public function delete_product($bind) {
        // --
        try {
            // --
            $sql = 'DELETE FROM products 
            where id = :id_product';
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