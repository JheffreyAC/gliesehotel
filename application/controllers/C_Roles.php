<?php 
// --
class C_Roles extends Controller {

    // --
    public function __construct() {
		parent::__construct();
    }
    
    // --
    public function index() {
        // --
        $this->functions->validate_session($this->segment->get('isActive'));
        $this->functions->check_permissions($this->segment->get('modules'), 'Roles');
        // --
        $this->view->set_js('index');       // -- Load JS
        $this->view->set_menu(array('modules' => $this->segment->get('modules'), 'view' => 'Roles')); // -- Active Menu
        $this->view->set_view('index');     // -- Load View  
    }

    // --
    public function get_roles() {
        // --
        $this->functions->validate_session($this->segment->get('isActive'));
        // --
        $request = $_SERVER['REQUEST_METHOD'];
        // --
        if ($request === 'GET') {
            // --
            $input = json_decode(file_get_contents('php://input'), true);
            if (empty($input)) {
                $input = filter_input_array(INPUT_GET);
            }
            // --
            $obj = $this->load_model('Roles');
            // --
            $response = $obj->get_roles();
            // --
            switch ($response['status']) {
                // --
                case 'OK':
                    // --
                    $json = array(
                        'status' => 'OK',
                        'type' => 'success',
                        'msg' => 'Listado de registros encontrados.',
                        'data' => array()
                    );
                    // --                           
                    foreach ($response['result'] as $item) {
                        // --
                        $json['data'][] = array(
                            'id' => $item['id'],
                            'description' => $item['description'],
                            //'timestamp' => date("d/m/Y H:i:s", $item['timestamp']),
                            'status' => $item['status']
                        );
                    }
                    // --
                    break;

                case 'ERROR':
                    // --
                    $json = array(
                        'status' => 'ERROR',
                        'type' => 'warning',
                        'msg' => 'No se encontraron registros en el sistema.',
                    );
                    // --
                    break;

                case 'EXCEPTION':
                    // --
                    $json = array(
                        'status' => 'ERROR',
                        'type' => 'error',
                        'msg' => $response['result']->getMessage(),
                    );
                    // --
                    break;
            }
            
        } else {
            // --
            $json = array(
                'status' => 'ERROR',
                'type' => 'error',
                'msg' => 'Método no permitido.',
            ); 
        }

        // --
        header('Content-Type: application/json');
        echo json_encode($json);
    }

    // --
    public function create_role() {
        // --
        $this->functions->validate_session($this->segment->get('isActive'));
        // --
        $request = $_SERVER['REQUEST_METHOD'];
        // --
        if ($request === 'POST') {
            // --
            $input = json_decode(file_get_contents('php://input'), true);
            if (empty($input)) {
                $input = filter_input_array(INPUT_POST);
            }
            // --
            if (
                !empty($input['description']) && 
                !empty($input['permission'])
            ) {
                // --
                $description = $this->functions->clean_string(strtoupper($input['description']));
                $permission = json_decode($input['permission'], true);
                // --
                $bind = array(
                    'description' => $description,
                    'permission' =>  $permission
                );
                // --
                $obj = $this->load_model('Roles');
                $response = $obj->create_role($bind);
                // --
                switch ($response['status']) {
                    // --
                    case 'OK':
                        // --
                        $json = array(
                            'status' => 'OK',
                            'type' => 'success',
                            'msg' => 'Registro almacenado en el sistema con éxito.',
                            'data' => array()
                        );
                        // --
                        break;

                    case 'ERROR':
                        // --
                        $json = array(
                            'status' => 'ERROR',
                            'type' => 'warning',
                            'msg' => 'No fue posible guardar el registro ingresado, verificar.',
                        );
                        // --
                        break;

                    case 'EXCEPTION':
                        // --
                        $json = array(
                            'status' => 'ERROR',
                            'type' => 'error',
                            'msg' => $response['result']->getMessage(),
                        );
                        // --
                        break;
                }
            } else {
                // --
                $json = array(
                    'status' => 'ERROR',
                    'type' => 'warning',
                    'msg' => 'No se enviaron los campos necesarios, verificar.',
                );
            }
            
        } else {
            // --
            $json = array(
                'status' => 'ERROR',
                'type' => 'error',
                'msg' => 'Método no permitido.',
            ); 
        }

        // --
        header('Content-Type: application/json');
        echo json_encode($json);
    }

    // --
    public function update_role() {
        // --
        $this->functions->validate_session($this->segment->get('isActive'));
        // --
        $request = $_SERVER['REQUEST_METHOD'];
        // --
        if ($request === 'POST') {
            // --
            $input = json_decode(file_get_contents('php://input'), true);
            if (empty($input)) {
                $input = filter_input_array(INPUT_POST);
            }
            // --
            if (
                !empty($input['id_role']) && 
                !empty($input['description']) && 
                !empty($input['permission'])
            ) {
                // --
                $id_role = $this->functions->clean_string($input['id_role']);
                $description = $this->functions->clean_string(strtoupper($input['description']));
                $permission = json_decode($input['permission'], true);

                // --
                $bind = array(
                    'id_role' => $id_role,
                    'description' => $description,
                    'permission' =>  $permission,
                );
                
                // --
                $obj = $this->load_model('Roles');
                $response = $obj->update_role($bind);
                // --
                switch ($response['status']) { 
                    // --
                    case 'OK':
                        // --
                        $json = array(
                            'status' => 'OK',
                            'type' => 'success',
                            'msg' => 'Registro actualizado en el sistema con éxito.',
                            'data' => array()
                        );
                        // --
                        break;

                    case 'ERROR':
                        // --
                        $json = array(
                            'status' => 'ERROR',
                            'type' => 'warning',
                            'msg' => 'No fue posible actualizar el registro ingresado, verificar.',
                        );
                        // --
                        break;

                    case 'EXCEPTION':
                        // --
                        $json = array(
                            'status' => 'ERROR',
                            'type' => 'error',
                            'msg' => $response['result']->getMessage(),
                        );
                        // --
                        break;
                }
            } else {
                // --
                $json = array(
                    'status' => 'ERROR',
                    'type' => 'warning',
                    'msg' => 'No se enviaron los campos necesarios, verificar.',
                );
            }
            
        } else {
            // --
            $json = array(
                'status' => 'ERROR',
                'type' => 'error',
                'msg' => 'Método no permitido.',
            ); 
        }
        // --
        header('Content-Type: application/json');
        echo json_encode($json);
    }

    // --
    public function delete_role() {
        // --
        $this->functions->validate_session($this->segment->get('isActive'));
        // --
        $request = $_SERVER['REQUEST_METHOD'];
        // --
        if ($request === 'POST') {
            // --
            $input = json_decode(file_get_contents('php://input'), true);
            if (empty($input)) {
                $input = filter_input_array(INPUT_POST);
            }
            // --
            if (!empty($input['id_role'])) {
                // --
                $id_role = $this->functions->clean_string($input['id_role']);
                // --
                $bind = array(
                    'id_role' => $id_role
                );
                // --
                $obj = $this->load_model('Roles');
                $response = $obj->delete_role($bind);
                // --
                switch ($response['status']) {
                    // --
                    case 'OK':
                        // --
                        $json = array(
                            'status' => 'OK',
                            'type' => 'success',
                            'msg' => 'Registro eliminado del sistema con éxito.',
                            'data' => array()
                        );
                        // --
                        break;

                    case 'ERROR':
                        // --
                        $json = array(
                            'status' => 'ERROR',
                            'type' => 'warning',
                            'msg' => 'No fue posible eliminar el registro, verificar.',
                            'data' => array(),
                        );
                        // --
                        break;

                    case 'EXCEPTION':
                        // --
                        $json = array(
                            'status' => 'ERROR',
                            'type' => 'error',
                            'msg' => $response['result']->getMessage(),
                            'data' => array()
                        );
                        // --
                        break;
                }
            } else {
                // --
                $json = array(
                    'status' => 'ERROR',
                    'type' => 'warning',
                    'msg' => 'No se enviaron los campos necesarios, verificar.',
                    'data' => array()
                );
            }
        } else {
            // --
            $json = array(
                'status' => 'ERROR',
                'type' => 'error',
                'msg' => 'Método no permitido.',
                'data' => array()
            ); 
        }

        // --
        header('Content-Type: application/json');
        echo json_encode($json);
    }

    // --
    public function get_role() {
        // --
        $request = $_SERVER['REQUEST_METHOD'];
        // --
        if ($request === 'GET') {
            // --
            $input = json_decode(file_get_contents('php://input'), true);
            if (empty($input)) {
                $input = filter_input_array(INPUT_GET);
            }
            // --
            if (!empty($input['id_role'])) {
                // --
                $obj_roles = $this->load_model('Roles');
                $obj_menu = $this->load_model('Menu');
                // --
                $bind = array('id_role' => intval($input['id_role']));
                // --   
                $response_role = $obj_roles->get_role($bind);
                $response_menu_role = $obj_menu->get_menu_by_role($bind);
                $response_menu = $obj_menu->get_menu($bind);
                // --
                $menu_role = array();
                $index_menu_role = 0;
                // --
                foreach ($response_menu['result'] as $item_menu) {
                    // --
                    $menu_role[$index_menu_role] = $item_menu;
                    $menu_role[$index_menu_role]['status'] = 0;
                    // --
                    foreach ($response_menu_role['result'] as $item_role) {
                        // --
                        if (intval($item_role['id_sub_menu']) === intval($item_menu['id_sub_menu'])) {
                            $menu_role[$index_menu_role]['status'] = intval($item_role['status']);
                        }
                    }
                    // --
                    $index_menu_role++;
                }

                // --
                $group_menu = array();
                // --
                foreach ($menu_role as $item) {
                    $group_menu[$item['id_menu']][] = $item;
                }
                // --
                $menu = array();
                $index_menu = 0;
                // --
                foreach ($group_menu as $item) {
                    // --
                    foreach ($item as $row) {
                        // --
                        $menu[$index_menu]['id'] = $row['id_menu'];
                        $menu[$index_menu]['description'] = $row['description_menu'];
                        $menu[$index_menu]['icon'] = $row['icon_menu'];
                        $menu[$index_menu]['order'] = $row['order_menu'];
                        // --
                        $menu[$index_menu]['sub_menu'][] = array(
                            'id' => $row['id_sub_menu'],
                            'description' => $row['description_sub_menu'],
                            'icon' => $row['icon_sub_menu'],
                            'url' => $row['url_sub_menu'],
                            'order' => $row['order_sub_menu'],
                            'status' => $row['status']
                        );
                    }
                    // --
                    $index_menu++;
                }

                // --
                switch ($response_role['status']) {
                    // --
                    case 'OK':
                        // --
                        $json = array(
                            'status' => 'OK',
                            'type' => 'success',
                            'msg' => 'Listado de registros encontrados.',
                            'data' => array(
                                'role' => $response_role['result'],
                                'menu' => $menu
                            )
                        );
                        // --
                        break;

                    case 'ERROR':
                        // --
                        $json = array(
                            'status' => 'ERROR',
                            'type' => 'warning',
                            'msg' => 'No se encontraron registros en el sistema.',
                        );
                        // --
                        break;

                    case 'EXCEPTION':
                        // --
                        $json = array(
                            'status' => 'ERROR',
                            'type' => 'error',
                            'msg' => $response_role['result']->getMessage(),
                        );
                        // --
                        break;
                }
            } else {
                // --
                $json = array(
                    'status' => 'ERROR',
                    'type' => 'warning',
                    'msg' => 'No se enviaron los campos necesarios, verificar.',
                );
            }

        } else {
            // --
            $json = array(
                'status' => 'ERROR',
                'type' => 'error',
                'msg' => 'Método no permitido.',
            ); 
        }
      
        // --
        header('Content-Type: application/json');
        echo json_encode($json);
    }


    // // --
    // public function get_role_permission() {
    //     // --
    //     $json = $this->functions->verified_token($_SERVER['HTTP_AUTHORIZATION']);
    //     // --
    //     if ($json['status'] === 'OK') {
    //         // --
    //         $input = json_decode(file_get_contents('php://input'), true);
    //         if (empty($input)) {
    //             $input = filter_input_array(INPUT_GET);
    //         }
    //         // --
    //         if (!empty($input['id_role'])) {
    //             // --
    //             $obj_roles = $this->load_model('Roles');
    //             $obj_permissions = $this->load_model('Permissions');
    //             // --
    //             $bind = array('id_role' => intval($input['id_role']));
    //             // --   
    //             $response_role_permission = $obj_roles->get_role_permission($bind);
    //             $response_permissions = $obj_permissions->get_permissions();
    //             // --
    //             $data_role = array();
    //             $data_permissions = array();
    //             // --
    //             foreach ($response_permissions['result'] as $item) {
    //                 // --
    //                 $permissions = array(
    //                     'id' => $item['id'],
    //                     'description' => $item['description'],
    //                     'status_create' => '0',
    //                     'status_update' => '0',
    //                     'status_delete' => '0'
    //                 );
    //                 // --
    //                 foreach ($response_role_permission['result'] as $row) {
    //                     // --
    //                     $data_role = array(
    //                         'id' => $row['id_role'],
    //                         'description' => $row['role_description']
    //                     );

    //                     // --
    //                     if (intval($item['id']) == intval($row['id_permission'])) {
    //                         // --
    //                         $permissions['status_create'] = $row['status_create'];
    //                         $permissions['status_update'] = $row['status_update'];
    //                         $permissions['status_delete'] = $row['status_delete'];
    //                     }
    //                 }

    //                 // --
    //                 $data_permissions[] = $permissions;
    //             }

    //             // --
    //             switch ($response_role_permission['status']) {
    //                 // --
    //                 case 'OK':
    //                     // --
    //                     $json = array(
    //                         'status' => 'OK',
    //                         'type' => 'success',
    //                         'msg' => 'Listado de registros encontrados.',
    //                         'data' => array(
    //                             'role' => $data_role,
    //                             'permissions' => $data_permissions
    //                         )
    //                     );
    //                     // --
    //                     break;

    //                 case 'ERROR':
    //                     // --
    //                     $json = array(
    //                         'status' => 'ERROR',
    //                         'type' => 'warning',
    //                         'msg' => 'No se encontraron registros en el sistema.',
    //                         'data' => array(),
    //                     );
    //                     // --
    //                     break;

    //                 case 'EXCEPTION':
    //                     // --
    //                     $json = array(
    //                         'status' => 'ERROR',
    //                         'type' => 'error',
    //                         'msg' => $response_role_permission['result']->getMessage(),
    //                         'data' => array()
    //                     );
    //                     // --
    //                     break;
    //             }
    //         } else {
    //             // --
    //             $json = array(
    //                 'status' => 'ERROR',
    //                 'type' => 'warning',
    //                 'msg' => 'No se enviaron los campos necesarios, verificar.',
    //                 'data' => array()
    //             );
    //         }

    //     }
      
    //     // --
    //     header('Content-Type: application/json');
    //     echo json_encode($json);
    // }
    
}