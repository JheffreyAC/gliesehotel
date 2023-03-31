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
                        i.id AS id_income,
                        i.id_supplier,
                        s.business_name, 
                        i.id_voucher_type,
                        vt.description AS vt_description,
                        i.id_payment_type,
                        pt.description AS pt_description,
                        i.id_user,
                        u.first_name,
                        i.proof_date,
                        i.proof_series,
                        i.voucher_series,
                        i.igv,
                        i.number_installments,
                        i.installment_value,
                        i.full_purchase,
                        i.status
                    FROM income i 
                    INNER JOIN supplier s ON s.id = i.id_supplier
                    INNER JOIN voucher_type vt ON vt.id = i.id_voucher_type
                    INNER JOIN user u ON u.id = i.id_user
                    INNER JOIN payment_type pt ON pt.id = i.id_payment_type
                    WHERE i.status = 1';
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
                    i.id AS id_income,
                    i.id_supplier,
                    s.business_name, 
                    i.id_voucher_type,
                    vt.description AS vt_description,
                    i.id_payment_type,
                    pt.description AS pt_description,
                    i.id_user,
                    u.first_name,
                    i.proof_date,
                    i.proof_series,
                    i.voucher_series,
                    i.igv,
                    i.number_installments,
                    i.installment_value,
                    i.full_purchase,
                    i.status
                FROM income i 
                INNER JOIN supplier s ON s.id = i.id_supplier
                INNER JOIN voucher_type vt ON vt.id = i.id_voucher_type
                INNER JOIN user u ON u.id = i.id_user
                INNER JOIN payment_type pt ON pt.id = i.id_payment_type
                WHERE i.id = :id_income AND i.status = 1';
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
     public function update_income($bind) {
        // --
        try {
            // --
            $sql = 'UPDATE income 
                SET
                    id_suplier = :id_suplier,
                    id_user = :id_user,
                    id_voucher_type = :id_voucher_type,
                    id_payment_type = :id_payment_type,
                    proof_series = :proof_series,
                    voucher_series = :voucher_series,
                    proof_date = :proof_date,
                    igv = igv,
                    number_installments = :number_installments,
                    installment_value = :installment_value,
                    full_purchase = :full_purchase
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