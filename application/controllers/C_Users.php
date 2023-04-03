<?php
// --
class C_Users extends Controller {

    // --
    public function __construct() {
		parent::__construct();
    }
    
    // --
    public function index() {
        // --
        $this->functions->validate_session($this->segment->get('isActive'));
        $this->functions->check_permissions($this->segment->get('modules'), 'Users');
        // --
        $this->view->set_js('index');       // -- Load JS
        $this->view->set_menu(array('modules' => $this->segment->get('modules'), 'view' => 'Users')); // -- Active Menu
        $this->view->set_view('index');     // -- Load View
    }

    // --
    public function get_users() {
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
            $obj = $this->load_model('Users');
            // --
            $response = $obj->get_users();
            // --
            switch ($response['status']) {
                // --
                case 'OK':
                    // --
                    $json = array(
                        'status' => 'OK',
                        'type' => 'success',
                        'msg' => 'Listado de registros encontrados.',
                        'data' => $response['result']
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
    public function get_user_statistics() {
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
            $obj = $this->load_model('Users');
            $response = $obj->get_users();
            // --
            $data_active = 0;
            $data_inactive = 0;
            // --                           
            foreach ($response['result'] as $item) {
                // --
                if (intval($item['active']) === 1) {
                    $data_active++;
                } else {
                    $data_inactive++;
                }
            }
            // --
            $result = array(
                'total' => $data_active + $data_inactive,
                'active' => $data_active,
                'inactive' => $data_inactive
            );
            // --
            switch ($response['status']) {
                // --
                case 'OK':
                    // --
                    $json = array(
                        'status' => 'OK',
                        'type' => 'success',
                        'msg' => 'Listado de registros encontrados.',
                        'data' => $result
                    );

                    // --
                    break;

                case 'ERROR':
                    // --
                    $json = array(
                        'status' => 'ERROR',
                        'type' => 'warning',
                        'msg' => 'No se encontraron registros en el sistema.',
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
    public function get_user_by_id() {
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
            if (!empty($input['id_user'])) {
                // --
                $id_user = $this->functions->clean_string($input['id_user']);
                // --
                $bind = array(
                    'id_user' => $id_user
                );
                // --
                $obj_users = $this->load_model('Users');
                // --
                $response = $obj_users->get_user_by_id($bind);
                // --
                switch ($response['status']) {
                    // --
                    case 'OK':
                        // --
                        $result_user = $response['result'][0];
                        $campus = [];
                        // --
                        foreach ($response['result'] as $item) {
                            $campus[] = array(
                                'id' => $item['id_campus'],
                                'description' => $item['campus']
                            );
                        }
                        // --
                        $user = array(
                            'id' => $result_user['id_user'],
                            'id_document_type' => $result_user['id_document_type'],
                            'document_type' => $result_user['document_type'],
                            'document_number' => $result_user['document_number'],
                            'id_role' => $result_user['id_role'],
                            'role' => $result_user['role'],
                            'user' => $result_user['user'],
                            'first_name' => $result_user['first_name'],
                            'last_name' => $result_user['last_name'],
                            'email' => $result_user['email'],
                            'telephone' => $result_user['telephone'],
                            'address' => $result_user['address'],
                            'active' => $result_user['active'],
                            'status' => $result_user['status']
                        );
                        // --
                        $json = array(
                            'status' => 'OK',
                            'type' => 'success',
                            'msg' => 'Listado de registros encontrados.',
                            'data' => array(
                                'user' => $user,
                                'campus' => $campus
                            ),
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
                            'msg' => $response['result']->getMessage(),
                        );
                        // --
                        break;
                }
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
    public function create_user() {
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
            if (!empty($input['first_name']) &&
                !empty($input['last_name']) &&
                !empty($input['document_type']) &&
                !empty($input['document_number']) &&
                // !empty($input['address']) && // -- Optional
                !empty($input['user']) &&
                !empty($input['password']) &&
                !empty($input['telephone']) &&
                !empty($input['email']) &&
                !empty($input['role']) &&
                !empty($input['campus']) &&
                !empty($input['description_document_type'])
            ) {
                // --
                $first_name = $this->functions->clean_string(strtolower($input['first_name']));
                $last_name = $this->functions->clean_string(strtolower($input['last_name']));
                $document_type = $this->functions->clean_string($input['document_type']);
                $document_number = $this->functions->clean_string($input['document_number']);
                $description_document_type = $this->functions->clean_string($input['description_document_type']);
                $address = $this->functions->clean_string($input['address']);
                $user = $this->functions->clean_string($input['user']);
                $password = $this->functions->encrypt_password($input['password']);
                $telephone = $this->functions->clean_string($input['telephone']);
                $email = $this->functions->clean_string($input['email']);
                $role = $this->functions->clean_string($input['role']);
                $campus = json_decode($input['campus'], true);
                $is_verified = $this->functions->verified_document_type($description_document_type, $document_number); // -- verified document type
                // --
                if ($is_verified) {
                    // --
                    $bind = array(
                        'first_name' => $first_name,
                        'last_name' => $last_name,
                        'id_document_type' => $document_type,
                        'document_number' => $document_number,
                        'address' => $address,
                        'user' => $user,
                        'password' => $password,
                        'telephone' => $telephone,
                        'email' => $email,
                        'id_role' => $role,
                        'campus' => $campus,
                        
                    );
                    // --
                    $obj = $this->load_model('Users');
                    $response = $obj->create_user($bind);
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
                    $json = array(
                        'status' => 'ERROR',
                        'type' => 'warning',
                        'msg' => 'Número de documento invalido, verificar.',
                    );
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
            ); 
        }

        // --
        header('Content-Type: application/json');
        echo json_encode($json);
    }

    // --
    public function update_user() {
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
            if (!empty($input['id_user']) &&
                !empty($input['first_name']) &&
                !empty($input['last_name']) &&
                !empty($input['document_type']) &&
                !empty($input['document_number']) &&
                // !empty($input['address']) && // -- Optional
                !empty($input['user']) &&
                !empty($input['telephone']) &&
                !empty($input['email']) &&
                !empty($input['role']) &&
                !empty($input['campus']) &&
                !empty($input['description_document_type'])
            ) {
                // --
                $id_user = $this->functions->clean_string($input['id_user']);
                $first_name = $this->functions->clean_string(ucfirst ($input['first_name']));
                $last_name = $this->functions->clean_string(ucfirst ($input['last_name']));
                $document_type = $this->functions->clean_string($input['document_type']);
                $description_document_type = $this->functions->clean_string($input['description_document_type']);
                $document_number = $this->functions->clean_string($input['document_number']);
                $address = $this->functions->clean_string($input['address']);
                $user = $this->functions->clean_string($input['user']);
                $telephone = $this->functions->clean_string($input['telephone']);
                $email = $this->functions->clean_string($input['email']);
                $role = $this->functions->clean_string($input['role']);
                $active = $this->functions->clean_string($input['active']);
                $campus = json_decode($input['campus'], true);
                $is_verified = $this->functions->verified_document_type($description_document_type, $document_number); // -- verified document type
                // --
                if ($is_verified) {
                    // --
                    $obj_campus = $this->load_model('Campus');
                    $response_campus = $obj_campus->get_campus();
                    // --
                    $array_campus = array();
                    // --
                    foreach ($response_campus['result'] as $item) {
                        // --
                        $status = 0; // -- Inactive for default
                        // --
                        foreach ($campus as $row) {
                            // --
                            if (intval($row) === intval($item['id'])) {
                                $status = 1; // -- Active
                            }
                        }
                        // --
                        $array_campus[] = array(
                            'id' => $item['id'],
                            'status' => $status
                        );
                    }
                    // --
                    $bind = array(
                        'id_user' => $id_user,
                        'id_role' => $role,
                        'id_document_type' => $document_type,
                        'first_name' => $first_name,
                        'last_name' => $last_name,
                        'document_number' => $document_number,
                        'address' => $address,
                        'user' => $user,
                        'telephone' => $telephone,
                        'email' => $email,
                        'campus' => $array_campus,
                        'active' => $active,
                        'ts_start' => time() // -- usar timestamp papis
                    );
                    // --
                    $obj = $this->load_model('Users');
                    $response = $obj->update_user($bind);
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
                    $json = array(
                        'status' => 'ERROR',
                        'type' => 'warning',
                        'msg' => 'Número de documento invalido, verificar.',
                    );
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
    public function delete_user() {
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
            if (!empty($input['id_user'])) {
                // --
                $id_user = $this->functions->clean_string($input['id_user']);
                $session_id_user = $this->segment->get('data')['id_user'];
                // --
                if (intval($id_user) === intval($session_id_user)) {
                    // --
                    $json = array(
                        'status' => 'ERROR',
                        'type' => 'warning',
                        'msg' => 'No puedes eliminar un usuario que esta siendo usado.',
                        'data' => array()
                    );
                } else{
                    // --
                    $bind = array(
                        'id_user' => $id_user
                    );
                    // --
                    $obj = $this->load_model('Users');
                    $response = $obj->delete_user($bind);
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
    public function update_user_password() {
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
                !empty($input['id_user']) && 
                !empty($input['password']) && 
                !empty($input['new_password'])
            )  {
                // --
                $id_user = $this->functions->clean_string($input['id_user']);
                $password = $this->functions->encrypt_password($input['password']); // -- actual
                $new_password = $this->functions->encrypt_password($input['new_password']); // -- nueva contraseña
                // --
                $bind = array(
                    'id_user' => $id_user,
                    'password' => $password,
                    'new_password' => $new_password
                );
                // --
                $obj = $this->load_model('Users');
                $response_validate = $obj->validate_user_password($bind); 
                // --
                switch ($response_validate['status']) {
                    case 'OK':
                        // --
                        $response_update = $obj->update_user_password($bind);
                        // --
                        switch ($response_update['status']) {
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
                                    'msg' => 'No fue posible actualizar la contraseña ingresada, verificar.',
                                );
                                // --
                                break;

                            case 'EXCEPTION':
                                // --
                                $json = array(
                                    'status' => 'ERROR',
                                    'type' => 'error',
                                    'msg' => $response_update['result']->getMessage(),
                                );
                                // --
                                break;
                        }
                        // --
                        break;

                    case 'ERROR':
                        // --
                        $json = array(
                            'status' => 'ERROR',
                            'type' => 'warning',
                            'msg' => 'No fue posible actualizar la contraseña ingresada, verificar.',
                        );
                        // --
                        break;

                    case 'EXCEPTION':
                        // --
                        $json = array(
                            'status' => 'ERROR',
                            'type' => 'error',
                            'msg' => $response_validate['result']->getMessage(),
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

    
}
