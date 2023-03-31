<?php
// --
class C_Main extends Controller {

    // --
    public function __construct() {
		parent::__construct();
    }
    
    // --
    public function index() {
        // -- 
        $this->functions->validate_session($this->segment->get('isActive'));
    }
    
    // --
    public function close_session() {
        // -- The destroyers
        $this->session->destroy();
        // --
        $json = array(
            'status' => 'OK',
            'msg' => 'Destruyendo sesión...'
        );
        // --
        header('Content-Type: application/json');
        echo json_encode($json);
    }
    
    // --
    public function get_document_types() {
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
            $obj = $this->load_model('Main');
            // --
            $response = $obj->get_document_types();
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
    public function get_voucher_type() {
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
            $obj = $this->load_model('Main');
            // --
            $response = $obj->get_voucher_type();
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
    public function get_payment_type() {
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
            $obj = $this->load_model('Main');
            // --
            $response = $obj->get_payment_type();
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
                'type' => 'error',
                'msg' => 'Método no permitido.',
                'data' => array()
            ); 
        }

        // --
        header('Content-Type: application/json');
        echo json_encode($json);
    }

    // // --
    // public function get_campus() {
    //     // --
    //     $request = $_SERVER['REQUEST_METHOD'];
    //     // --
    //     if ($request === 'GET') {
    //         // --
    //         $json = $this->functions->verified_token($_SERVER['HTTP_AUTHORIZATION']);
    //         // --
    //         if ($json['status'] === 'OK') {
    //             // --
    //             $input = json_decode(file_get_contents('php://input'), true);
    //             if (empty($input)) {
    //                 $input = filter_input_array(INPUT_GET);
    //             }
    //             // --
    //             $obj = $this->load_model('Main');
    //             // --
    //             $response = $obj->get_campus();
    //             // --
    //             switch ($response['status']) {
    //                 // --
    //                 case 'OK':
    //                     // --
    //                     $json = array(
    //                         'status' => 'OK',
    //                         'type' => 'success',
    //                         'msg' => 'Listado de registros encontrados.',
    //                         'data' => $response['result']
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
    //                         'msg' => $response['result']->getMessage(),
    //                         'data' => array()
    //                     );
    //                     // --
    //                     break;
    //             }
    //         }
    //     } else {
    //         // --
    //         $json = array(
    //             'status' => 'ERROR',
    //             'type' => 'error',
    //             'msg' => 'Método no permitido.',
    //             'data' => array()
    //         ); 
    //     }

    //     // --
    //     header('Content-Type: application/json');
    //     echo json_encode($json);
    // }
}
    