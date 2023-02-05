<?php 
// --
// -- JEREMI
class M_Users extends Model {

    // --
    public function __construct() {
		parent::__construct();
    }
    
	// --
	public function get_users() {
        // --
        try {
            // --
            $sql = 'SELECT
					u.id AS id_user,
					u.id_document_type,
					dt.description AS document_type,
					u.document_number,
                    u.user,
					u.first_name,
					u.last_name,
					u.email,
                    u.telephone,
                    u.address,
                    u.active,
					u.status
				FROM user u
				INNER JOIN document_type dt ON dt.id = u.id_document_type
                WHERE u.status = 1';
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
	public function get_user_by_id($bind) {
        // --
        try {
            // --
            $sql = 'SELECT
                    u.id AS id_user,
                    u.id_document_type,
                    dt.description AS document_type,
                    u.document_number,
                    u.id_role,
                    r.description as role,
                    u.user,
                    u.first_name,
                    u.last_name,
                    u.email,
                    u.telephone,
                    u.address,
                    u.active,
                    u.status,
                    uc.id_campus,
                    c.description as campus
                FROM USER u
                INNER JOIN document_type dt ON dt.id = u.id_document_type
                INNER JOIN user_campus uc ON uc.id_user = u.id
                INNER JOIN campus c ON c.id = uc.id_campus
                INNER JOIN role r ON r.id = u.id_role
                WHERE u.id = :id_user AND u.status = 1';
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

    // --
    public function create_user($bind) {
        // --
        $this->pdo->beginTransaction();
        // --
        try {
            // --
            $sql = 'INSERT INTO user 
            (
                id_role,
                id_document_type,
                first_name,
                last_name,
                document_number,
                address,
                telephone,
                email,
                user,
                password
            ) 
            VALUES 
            (
                :id_role,
                :id_document_type,
                :first_name,
                :last_name,
                :document_number,
                :address,
                :telephone,
                :email,
                :user,
                :password
            )';
            // --
            $result = $this->pdo->perform($sql, $bind);
            $id = $this->pdo->lastInsertId();
            $status_transaction = false;
            // --
            if ($result) {
                // --
                $status_transaction = true;
                // --
                foreach ($bind['campus'] as $value) {
                    // -- Create parameters
                    $bind_campus = array(
                        'id_user' => $id,
                        'id_campus' => $value
                    );
                    // --
                    $sql_insert = 'INSERT INTO user_campus (id_user, id_campus) VALUES (:id_user, :id_campus)';
                    $result_insert = $this->pdo->perform($sql_insert, $bind_campus);
                    // --
                    if (!$result_insert) {
                        // --
                        $status_transaction = false;
                        break;
                    }
                }
            }
            // --
            if ($status_transaction) {
                // --
                $response = array('status' => 'OK', 'result' => array());
                $this->pdo->commit();

            } else {
                // --
                $response = array('status' => 'ERROR', 'result' => array());
                $this->pdo->rollBack();
            }
        } catch (PDOException $e) {
            // --
            $response = array('status' => 'EXCEPTION', 'result' => $e);
            $this->pdo->rollBack();
        }
        // --
        return $response;
    }

    // --
    public function update_user($bind) {
        // --
        $this->pdo->beginTransaction();
        // --
        try {
            // --
            $sql = 'UPDATE user 
                SET 
                    id_document_type = :id_document_type,
                    id_role = :id_role,
                    first_name = :first_name,
                    last_name = :last_name,
                    document_number = :document_number,
                    address = :address,
                    telephone = :telephone,
                    email = :email,
                    user = :user,
                    active = :active
                WHERE id = :id_user
            ';
            // --
            $result = $this->pdo->perform($sql, $bind);
            $status_transaction = false;
            // --
            if ($result) {
                // --
                $status_transaction = true;
                // --
                foreach ($bind['campus'] as $item) {
                    // --
                    $bind_campus = array(
                        'id_user' => $bind['id_user'], 
                        'id_campus' => $item['id'], 
                        'status' => $item['status']
                    );
                    // --
                    $sql_select = 'SELECT id, id_user, id_campus FROM user_campus WHERE id_user = :id_user AND id_campus = :id_campus';
                    $result_select = $this->pdo->fetchOne($sql_select, $bind_campus);
                    // --
                    if ($result_select) {
                        // --
                        $sql_update = 'UPDATE user_campus SET status = :status WHERE id_user = :id_user AND id_campus = :id_campus';
                        // --
                        $result_update= $this->pdo->perform($sql_update, $bind_campus);
                        // --
                        if (!$result_update) {
                            // --
                            $status_transaction = false;
                            break;
                        }
                    } else {
                        // --
                        $sql_insert = 'INSERT INTO user_campus (id_user, id_campus, status) VALUES (:id_user, :id_campus, :status)';
                        $result_insert = $this->pdo->perform($sql_insert, $bind_campus);
                        // --
                        if (!$result_insert) {
                            // --
                            $status_transaction = false;
                            break;
                        }
                    }
                }
            }
            // --
            if ($status_transaction) {
                // --
                $response = array('status' => 'OK', 'result' => array());
                $this->pdo->commit();

            } else {
                // --
                $response = array('status' => 'ERROR', 'result' => array());
                $this->pdo->rollBack();
            }
        } catch (PDOException $e) {
            // --
            $response = array('status' => 'EXCEPTION', 'result' => $e);
            $this->pdo->rollBack();
        }
        // --
        return $response;
    }

    // --
    public function delete_user($bind) {
        // --
        try {
            // --
            $sql = 'UPDATE user SET status = 0 WHERE id = :id_user';
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
    public function validate_user_password($bind) {
        // --
        try {
            // --
            $sql = 'SELECT id FROM user WHERE password = :password AND id = :id_user';
            // --
            $result = $this->pdo->fetchOne($sql, $bind);
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
    public function update_user_password($bind) {
        // --
        try {
            // --
            $sql = 'UPDATE user
                SET 
                    password = :new_password
                WHERE id = :id_user';
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
