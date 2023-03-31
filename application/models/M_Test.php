<?php 
// --
class M_Test extends Model {
    // --
    public function __construct() {
		parent::__construct();
    }

    // --
    public function create_income($bind) {
        // --
        try {
            // --
            $sql = 'INSERT INTO income 
            (
                id_suplier, 
                id_user,
                id_voucher_type,
                id_payment_type,
                proof_series,
                voucher_series,
                proof_date,
                igv,
                number_installments,
                installment_value,
                full_purchase
            ) 
            VALUES 
            (
                :id_suplier,
                :id_user,
                :id_voucher_type,
                :id_payment_type
                :proof_series,
                :voucher_series,
                :proof_date,
                :igv,
                :number_installments,
                :installment_value,
                :full_purchase     
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