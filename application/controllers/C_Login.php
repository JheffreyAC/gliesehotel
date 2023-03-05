<?php
// -- TU PAPI
class C_Login extends Controller {

    // --
    public function __construct() {
		parent::__construct();
    }
    
    // --
    public function index() {
        // --
        $this->functions->check_session($this->segment->get('isActive'));
        $this->view->set_js('index');
        $this->view->set_view('default');
    }

    // --
    public function login() { 
        // ---
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
                isset($input['user']) && 
                isset($input['password'])
            ) {
                // --
                $obj_login = $this->load_model('Login');
                $obj_menu = $this->load_model('Menu');
                // --
                $user = trim($input['user']);
                $password = $this->functions->encrypt_password($input['password']);
                // --
                $bind = array(
                    'user' => $user,
                    'password' => $password,
                    'status' => 1 
                );
                // --
                $response = $obj_login->get_user($bind);
                // --
                switch ($response['status']) {
                    // --
                    case 'OK':
                        // --
                        $result_user = $response['result'][0]; // -- First
                        // --    
                        $bind_validate = array(
                            'id_user' => $result_user['id_user'],
                            'active' => 1
                        );
                        // --
                        $response_validate = $obj_login->validate_user($bind_validate);
                        // --
                        switch ($response_validate['status']) {
                            // --
                            case 'OK':
                                // --
                                $campus = array();
                                // --
                                foreach ($response['result'] as $item) {
                                // --
                                    $campus[] = array('id' => $item['id_campus'], 'description' => $item['description_campus']);
                                }
                                // --
                                $bind_menu = array('id_role' => $result_user['id_role']);
                                $menu = $obj_menu->get_menu_by_role($bind_menu);
                                // 
                                $data = array(
                                    'id_user' => $result_user['id_user'],
                                    'id_role' => $result_user['id_role'],
                                    'id_document_type' => $result_user['id_document_type'],
                                    'document_number' => $result_user['document_number'],
                                    'first_name' => $result_user['first_name'],
                                    'last_name' => $result_user['last_name'],
                                    'role' => $result_user['description_role'],
                                    'campus' => $campus
                                );
                                // --
                                $group_menu = array();
                                // --
                                foreach ($menu['result'] as $item) {
                                    $group_menu[$item['id_menu']][] = $item;
                                }
                                // --
                                $menu = array();
                                $index = 0;
                                // --
                                foreach ($group_menu as $item) {
                                    // --
                                    foreach ($item as $row) {
                                        // --
                                        $menu[$index]['id'] = $row['id_menu'];
                                        $menu[$index]['description'] = $row['description_menu'];
                                        $menu[$index]['icon'] = $row['icon_menu'];
                                        $menu[$index]['order'] = $row['order_menu'];
                                        // --
                                        $menu[$index]['sub_menu'][] = array(
                                            'id' => $row['id_sub_menu'],
                                            'description' => $row['description_sub_menu'],
                                            'icon' => $row['icon_sub_menu'],
                                            'url' => $row['url_sub_menu'],
                                            'order' => $row['order_sub_menu']
                                        );
                                    }
                                    // --
                                    $index++;
                                }
                                // --
                                $this->segment->set('isActive', true);
                                $this->segment->set('data', $data);
                                $this->segment->set('modules', $menu);
                                // --
                                $json = array(
                                    'status' => 'OK',
                                    'msg' => 'Bienvenido(a) ' . $result_user['first_name']
                                );
                                // --
                                break;
                            case 'ERROR':
                                // --
                                $json = array(
                                    'status' => 'ERROR',
                                    'msg' => 'Cuenta desactivada, comuniquese con su administrador.'
                                );
                                // --
                                break;
            
                            case 'EXCEPTION':
                                // --
                                $json = array(
                                    'status' => 'ERROR',
                                    'msg' => $response['result']->getMessage(),
                                );
                                // --
                                break;
                            }
                        break;

                    case 'ERROR':
                        // --
                        $json = array(
                            'status' => 'ERROR',
                            'msg' => 'Credenciales de autenticación incorrectas.'
                        );
                        // --
                        break;

                    case 'EXCEPTION':
                        // --
                        $json = array(
                            'status' => 'ERROR',
                            'msg' => $response['result']->getMessage(),
                        );
                        // --
                        break;
                }

            } else {
                // --
                $json = array(
                    'status' => 'ERROR',
                    'msg' => 'Verificar parámetros.'
                ); 
            }
        } else {
            // --
            $json = array(
                'status' => 'ERROR',
                'msg' => 'Método no permitido.'
            ); 
        }

      
        // --
        header('Content-Type: application/json');
        echo json_encode($json);
    }

}