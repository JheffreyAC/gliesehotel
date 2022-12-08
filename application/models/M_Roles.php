<?php 
// --
class M_Roles extends Model {
    // --
    public function __construct() {
        parent::__construct();
    }
    
    // --
    public function get_roles() {
        // --
        try {
            // --
            $sql = 'SELECT 
                    id,
                    description,
                    status
                FROM role WHERE status = 1';
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
    public function get_role($bind) {
        // --
        try {
            // --
            $sql = 'SELECT 
                    id,
                    description,
                    status
                FROM role WHERE id = :id_role AND status = 1';
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
    public function create_role($bind) {
        // --
        $this->pdo->beginTransaction();
        // --
        try {
            // --
            $sql = 'INSERT INTO role (description) VALUES (:description)';
            // --
            $bind_role = array('description' => $bind['description']);
            // --
            $result = $this->pdo->perform($sql, $bind_role);
            $status_transaction = false;
            // --
            if ($result) {
                // --
                $status_transaction = true;
                $last_insert_id = $this->pdo->lastInsertId();
                // --
                foreach ($bind['permission'] as $item) {
                    // -- Create parameters
                    $bind_permission = array(
                        'id_role' => $last_insert_id,
                        'id_sub_menu' => $item['id_sub_menu'],
                        'status' => $item['status']
                    );
                    // --
                    $sql_menu_role = 'INSERT INTO permission (id_role, id_sub_menu, status) VALUES (:id_role, :id_sub_menu, :status)';
                    $result_menu_role = $this->pdo->perform($sql_menu_role, $bind_permission);
                    // --
                    if (!$result_menu_role) {
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
            $this->pdo->rollBack();
            $response = array('status' => 'EXCEPTION', 'result' => $e);
        }
        // --
        return $response;
    }
    
    // --
    public function update_role($bind) {
        // --
        $this->pdo->beginTransaction();
        // --
        try {
            // --
            $sql = 'UPDATE role 
                    SET 
                        description = :description
                    WHERE id = :id_role';
            // --
            $bind_role = array(
                'id_role' => $bind['id_role'],
                'description' => $bind['description']
            );
            // --
            $result = $this->pdo->perform($sql, $bind_role);
            $status_transaction = false;
            // --
            if ($result) {
                // --
                $status_transaction = true;
                // --
                foreach ($bind['permission'] as $item) {
                    // -- Create parameters
                    $bind_permission = array(
                        'id_role' => $bind['id_role'],
                        'id_sub_menu' => $item['id_sub_menu'],
                        'status' => $item['status']
                    );
                    // --
                    $sql_select_permission= 'SELECT * FROM permission WHERE id_role = :id_role AND id_sub_menu = :id_sub_menu';
                    $result_select_permission = $this->pdo->fetchOne($sql_select_permission, $bind_permission);
                    // --
                    if ($result_select_permission) {
                        // --
                        $sql_update_permission = 'UPDATE permission SET status = :status WHERE id_role = :id_role AND id_sub_menu = :id_sub_menu';
                        // --
                        $result_update_permission = $this->pdo->perform($sql_update_permission, $bind_permission);
                        // --
                        if (!$result_update_permission) {
                            // --
                            $status_transaction = false;
                            break;
                        }
                    } else {
                        // --
                        $sql_insert_permission= 'INSERT INTO permission (id_role, id_sub_menu, status) VALUES (:id_role, :id_sub_menu, :status)';
                        $result_insert_permission = $this->pdo->perform($sql_insert_permission, $bind_permission);
                        // --
                        if (!$result_insert_permission) {
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
            $this->pdo->rollBack();
            $response = array('status' => 'EXCEPTION', 'result' => $e);
        }
        // --
        return $response;
    }

    // --
    public function delete_role($bind) {
        // --
        try {
            // --
            $sql = 'DELETE FROM role where id = :id_role';
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