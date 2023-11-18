<?php
// --
class M_Product extends Model
{
    // --
    public function __construct()
    {
        parent::__construct();
    }
    public function get_product()
    {
        // --
        try {
            // --
            $sql = 'SELECT   
                      product.id_product,
                      product.product_sku,
                      product.product_name,
                      product.product_description,
                      categories.description,
                      product.product_price,
                      product.product_stock,
                      product.expiration_date,
                      product.status_expiration_date 
                      
                  FROM product
                  JOIN categories ON product.id_category=categories.id
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
    public function get_product_by_id($bind)
    {
        // --
        try {
            // --
            $sql = 'SELECT 
        product.id_product,
        product.product_sku,
        product.product_name,
        product.product_description,
        product.id_category,
        categories.description,
        product.product_price,
        product.expiration_date,
        product.status_expiration_date  
        FROM product 
        JOIN categories ON product.id_category=categories.id
        WHERE id_product = :id_product
        ';
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
}
