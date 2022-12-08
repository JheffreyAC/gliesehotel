<?php 
// --
class C_Permissions extends Controller {

    // --
    public function __construct() {
		parent::__construct();
    }
    
    // --
    public function index() {
        // --
        $this->functions->validate_session($this->segment->get('isActive'));
        $this->functions->check_permissions($this->segment->get('modules'), 'Permissions');
        // --
        $this->view->set_js('index');       // -- Load JS
        $this->view->set_menu(array('modules' => $this->segment->get('modules'), 'view' => 'Permissions')); // -- Active Menu
        $this->view->set_view('index');     // -- Load View
    }
    
    // --
    public function get_permissions() {
        // --
        $request = $_SERVER['REQUEST_METHOD'];
        // --
        if ($request === 'GET') {
            // --
            $json = $this->functions->verified_token($_SERVER['HTTP_AUTHORIZATION']);
            // --
            if ($json['status'] === 'OK') {
                // --
                $input = json_decode(file_get_contents('php://input'), true);
                if (empty($input)) {
                    $input = filter_input_array(INPUT_GET);
                }
                // --
                $obj = $this->load_model('Permissions');
                // --
                $response = $obj->get_permissions();
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
    public function get_permission() {
        // --
        $request = $_SERVER['REQUEST_METHOD'];
        // --
        if ($request === 'GET') {
            // --
            $json = $this->functions->verified_token($_SERVER['HTTP_AUTHORIZATION']);
            // --
            if ($json['status'] === 'OK') {
                // --
                $input = json_decode(file_get_contents('php://input'), true);
                if (empty($input)) {
                    $input = filter_input_array(INPUT_GET);
                }
                // --
                if (!empty($input['id_permission'])) {
                    // --
                    $obj = $this->load_model('Permissions');
                    // --
                    $bind = array('id_permission' => intval($input['id_permission']));
                    // --
                    $response = $obj->get_permission($bind);
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
                            $json['data'][] = array(
                                'id' => $response['result']['id'],
                                'description' => $response['result']['description'],
                                'status' => $response['result']['status']
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
                        'type' => 'warning',
                        'msg' => 'No se enviaron los campos necesarios, verificar.',
                    );
                }

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
    public function create_permission() {
        // --
        $request = $_SERVER['REQUEST_METHOD'];
        // --
        if ($request === 'POST') {
            // --
            $json = $this->functions->verified_token($_SERVER['HTTP_AUTHORIZATION']);
            // --
            if ($json['status'] === 'OK') {
                // --
                $input = json_decode(file_get_contents('php://input'), true);
                if (empty($input)) {
                    $input = filter_input_array(INPUT_POST);
                }
                // --
                if (!empty($input['description'])) {
                    // --
                    $description = $this->functions->clean_string($input['description']);
                    // --
                    $bind = array('description' => $description);
                    // --
                    $obj = $this->load_model('Permissions');
                    $response = $obj->create_permission($bind);
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
    public function update_permission() {
        // --
        $request = $_SERVER['REQUEST_METHOD'];
        // --
        if ($request === 'POST') {
            // --
            $json = $this->functions->verified_token($_SERVER['HTTP_AUTHORIZATION']);
            // --
            if ($json['status'] === 'OK') {
                // --
                $input = json_decode(file_get_contents('php://input'), true);
                if (empty($input)) {
                    $input = filter_input_array(INPUT_POST);
                }
                // --
                if (!empty($input['id_permission']) && !empty($input['description'])) {
                    // --
                    $id_permission = $this->functions->clean_string($input['id_permission']);
                    $description = $this->functions->clean_string($input['description']);
                    // --
                    $bind = array(
                        'id' => $id_permission,
                        'description' => $description
                    );
                    // --
                    $obj = $this->load_model('Permissions');
                    $response = $obj->update_permission($bind);
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
    public function delete_permission() {
        // --
        $request = $_SERVER['REQUEST_METHOD'];
        // --
        if ($request === 'POST') {
            // --
            $json = $this->functions->verified_token($_SERVER['HTTP_AUTHORIZATION']);
            // --
            if ($json['status'] === 'OK') {
                // --
                $input = json_decode(file_get_contents('php://input'), true);
                if (empty($input)) {
                    $input = filter_input_array(INPUT_POST);
                }
                // --
                if (!empty($input['id_permission'])) {
                    // --
                    $id_permission = $this->functions->clean_string($input['id_permission']);
                    // --
                    $bind = array(
                        'id_permission' => $id_permission
                    );
                    // --
                    $obj = $this->load_model('Permissions');
                    $response = $obj->delete_permission($bind);
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

}