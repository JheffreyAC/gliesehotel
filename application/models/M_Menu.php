<?php 
// --
class M_Menu extends Model {
    // --
    public function __construct() {
        parent::__construct();
    }
    
	// --
    // public function get_menu_by_user($bind) {
    //     // --
    //     try {
    //         // --
    //         $sql = 'SELECT 
    //                 m.id as id_menu,
    //                 m.description as description_menu,
    //                 m.icon as icon_menu,
    //                 m.order as order_menu,
    //                 sm.id as id_sub_menu,
    //                 sm.description as description_sub_menu,
    //                 sm.icon as icon_sub_menu,
    //                 sm.url as url_sub_menu,
    //                 sm.order as order_sub_menu,
    //                 mu.id_user,
    //                 mu.status
    //             FROM menu_user mu
    //             LEFT JOIN sub_menu sm on sm.id = mu.id_sub_menu
    //             LEFT JOIN menu m on m.id = sm.id_menu
    //             WHERE mu.id_user = :id_user AND mu.status = 1
    //             ORDER BY m.order, sm.order ASC';
    //         // --
    //         $result = $this->pdo->fetchAll($sql, $bind);
    //         // --
    //         if ($result) {
    //             // --
    //             $response = array('status' => 'OK', 'result' => $result);
    //         } else {
    //             // --
    //             $response = array('status' => 'ERROR', 'result' => array());
    //         }
    //     } catch (PDOException $e) {
    //         // --
    //         $response = array('status' => 'EXCEPTION', 'result' => $e);
    //     }
    //     // --
    //     return $response;
    // }

    // --
    public function get_menu_by_user($bind) {
        // --
        try {
            // --
            $sql_user = 'SELECT id, id_role FROM user WHERE id = :id_user';
            $result_user = $this->pdo->fetchOne($sql_user, $bind);
            // --
            if ($result_user) {
                // --
                $id_role = $result_user['id_role'];
                $bind_menu_role = array('id_role' => $id_role);
                // --
                $sql_menu_role = 'SELECT 
                    m.id as id_menu,
                    m.description as description_menu,
                    m.icon as icon_menu,
                    m.order as order_menu,
                    sm.id as id_sub_menu,
                    sm.description as description_sub_menu,
                    sm.icon as icon_sub_menu,
                    sm.url as url_sub_menu,
                    sm.order as order_sub_menu,
                    mr.id_role,
                    mr.status
                FROM menu_role mr
                LEFT JOIN sub_menu sm on sm.id = mr.id_sub_menu
                LEFT JOIN menu m on m.id = sm.id_menu
                WHERE mr.id_role = :id_role AND mr.status = 1
                ORDER BY m.order, sm.order ASC';
                // --
                $result_menu_role = $this->pdo->fetchAll($sql_menu_role, $bind_menu_role);
            }
            // --
            if ($result_menu_role) {
                // --
                $response = array('status' => 'OK', 'result' => $result_menu_role);
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
     public function get_menu_by_role($bind) {
        // --
        try {
            // --
            $sql = 'SELECT
                    m.id as id_menu,
                    m.description as description_menu,
                    m.icon as icon_menu,
                    m.order as order_menu,
                    sm.id as id_sub_menu,
                    sm.description as description_sub_menu,
                    sm.icon as icon_sub_menu,
                    sm.url as url_sub_menu,
                    sm.order as order_sub_menu,
                    p.status
                FROM permission p
                LEFT JOIN role r ON r.id = p.id_role
                LEFT JOIN sub_menu sm ON sm.id = p.id_sub_menu
                LEFT JOIN menu m ON m.id = sm.id_menu
                WHERE p.status = 1 AND r.id = :id_role
                ORDER BY m.order, sm.order ASC';
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

        //  // --
        //  public function get_menu_by_role($bind) {
        //     // --
        //     try {
        //         // --
        //         $sql = 'SELECT 
        //             m.id as id_menu,
        //             m.description as description_menu,
        //             m.icon as icon_menu,
        //             m.order as order_menu,
        //             sm.id as id_sub_menu,
        //             sm.description as description_sub_menu,
        //             sm.icon as icon_sub_menu,
        //             sm.url as url_sub_menu,
        //             sm.order as order_sub_menu,
        //             mr.id_role,
        //             mr.status
        //         FROM menu_role mr
        //         LEFT JOIN sub_menu sm on sm.id = mr.id_sub_menu
        //         LEFT JOIN menu m on m.id = sm.id_menu
        //         WHERE mr.id_role = :id_role
        //         ORDER BY m.order, sm.order ASC';
        //         // --
        //         $result = $this->pdo->fetchAll($sql, $bind);
        //         // --
        //         if ($result) {
        //             // --
        //             $response = array('status' => 'OK', 'result' => $result);
        //         } else {
        //             // --
        //             $response = array('status' => 'ERROR', 'result' => array());
        //         }
        //     } catch (PDOException $e) {
        //         // --
        //         $response = array('status' => 'EXCEPTION', 'result' => $e);
        //     }
        //     // --
        //     return $response;
        // }

    // --
    public function get_menu() {
        // --
        try {
            // --
            $sql = 'SELECT  
                    m.id as id_menu,
                    m.description as description_menu,
                    m.icon as icon_menu,
                    m.order as order_menu,
                    sm.id as id_sub_menu,
                    sm.description as description_sub_menu,
                    sm.icon as icon_sub_menu,
                    sm.url as url_sub_menu,
                    sm.order as order_sub_menu
                FROM sub_menu sm
                INNER JOIN menu m ON m.id = sm.id_menu
                ORDER BY m.order, sm.order ASC';
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

}