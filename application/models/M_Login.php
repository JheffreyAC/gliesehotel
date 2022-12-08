<?php 
// --
class M_Login extends Model {
    // --
    public function __construct() {
		  parent::__construct();
    }
    
    // --
    public function get_user($bind) {
        // --
        try {
            // --
            $sql = 'SELECT 
                    u.id as id_user,
                    u.id_role,
                    u.id_document_type, 
                    u.document_number,
                    u.first_name, 
                    u.last_name,
                    r.description as description_role,
                    c.id as id_campus,
                    c.description as description_campus
                FROM user u
                LEFT JOIN user_campus uc ON uc.id_user = u.id
                LEFT JOIN campus c ON c.id = uc.id_campus
                LEFT JOIN role r ON r.id = u.id_role
                WHERE
                    u.user = :user AND 
                    u.password = :password AND 
                    u.status = :status';
            // --
            $result = $this->pdo->fetchAll($sql, $bind);
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