<?php 
// --
class C_Suppliers extends Controller {

    // --
    public function __construct() {
		parent::__construct();
    }
    
    // --
    public function index() {
        // --
        $this->functions->validate_session($this->segment->get('isActive'));
        $this->functions->check_permissions($this->segment->get('modules'), 'Suppliers');
        // --
        $this->view->set_js('index');       // -- Load JS
        $this->view->set_menu(array('modules' => $this->segment->get('modules'), 'view' => 'Suppliers')); // -- Active Menu
        $this->view->set_view('index');     // -- Load View
    }

    // --
    public function get_suppliers() { 
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
            $obj = $this->load_model('Suppliers');
            // --
            $response = $obj->get_suppliers();
            // --
            switch ($response['status']) {
                // --
                case 'OK':
                    // --
                    $json = array(
                        'status' => 'OK',
                        'type' => 'success',
                        'msg' => $this->messages->message['list'],
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
    public function get_supplier_by_id() {
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
            if (!empty($input['id_supplier'])) {
                // --
                $obj = $this->load_model('Suppliers');
                // --
                $bind = array(
                    'id_supplier' => intval($input['id_supplier']));
                // --
                $response = $obj->get_supplier_by_id($bind);
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
    public function create_supplier() {
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
            if (!empty($input['document_type']) &&
                !empty($input['name']) &&
                !empty($input['document_number']) &&
                !empty($input['address']) &&
                !empty($input['phone']) &&
                !empty($input['business_name']) &&
                !empty($input['email']) 
            ) {
                // --
                $document_type = $this->functions->clean_string($input['document_type']);
                $name = $this->functions->clean_string(strtoupper($input['name']));
                $document_number = $this->functions->clean_string($input['document_number']);
                $address = $this->functions->clean_string($input['address']);
                $phone = $this->functions->clean_string($input['phone']);
                $business_name = $this->functions->clean_string($input['business_name']);
                $email = $this->functions->clean_string($input['email']);
                // --
                $bind = array(
                    'id_document_type' => $document_type,
                    'name' => $name,
                    'document_number' => $document_number,
                    'address' => $address,
                    'phone' => $phone,
                    'business_name' => $business_name,
                    'email' => $email
                );
                
                // --
                $obj = $this->load_model('Suppliers');
                $response = $obj->create_supplier($bind);
                // --
                switch ($response['status']) {
                    // --
                    case 'OK':
                        // --
                        $json = array(
                            'status' => 'OK',
                            'type' => 'success',
                            'msg' => 'Registro almacenado en el sistema con éxito.',
                            // 'msg' => ,
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
    public function update_supplier() {
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
            if (!empty($input['id_supplier']) && 
                !empty($input['document_type']) && 
                !empty($input['name']) &&
                !empty($input['document_number']) &&
                !empty($input['address']) &&
                !empty($input['phone'])&&
                !empty($input['business_name']) &&
                !empty($input['email'])  
            ) {
                // --
                $id_supplier = $this->functions->clean_string($input['id_supplier']);
                $document_type = $this->functions->clean_string($input['document_type']);
                $name = $this->functions->clean_string(strtoupper($input['name']));
                $document_number = $this->functions->clean_string($input['document_number']);
                $address = $this->functions->clean_string($input['address']);
                $phone = $this->functions->clean_string($input['phone']);
                $business_name = $this->functions->clean_string($input['business_name']);
                $email = $this->functions->clean_string($input['email']);
                // --
                $bind = array(
                    'id_supplier' => $id_supplier,
                    'id_document_type' => $document_type,
                    'name' => $name,
                    'document_number' => $document_number,
                    'address' => $address,
                    'phone' => $phone,
                    'business_name' => $business_name,
                    'email' => $email

                );
                // --
                $obj = $this->load_model('Suppliers');
                $response = $obj->update_supplier($bind);
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
    public function delete_supplier() {
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
            if (!empty($input['id_supplier'])) {
                // --
                $id_supplier = $this->functions->clean_string($input['id_supplier']);
                // --
                $bind = array(
                    'id_supplier' => $id_supplier
                );
                // --
                $obj = $this->load_model('Suppliers');
                $response = $obj->delete_supplier($bind);
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


    


    
}