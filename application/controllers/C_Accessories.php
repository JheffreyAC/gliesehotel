<?php 

// --
class C_Accessories extends Controller {

    // --
    public function __construct() {
		parent::__construct();
    }
    
    // --
    public function index() {
        // --
        $this->functions->validate_session($this->segment->get('isActive'));
        $this->functions->check_permissions($this->segment->get('modules'), 'Accessories');
        // --
        $this->view->set_js('index');       // -- Load JS
        $this->view->set_menu(array('modules' => $this->segment->get('modules'), 'view' => 'Accessories')); // -- Active Menu
        $this->view->set_view('index');     // -- Load View
    }
    public function get_accessories() { 
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
          $obj = $this->load_model('Accessories');
          // --
          $response = $obj->get_accessories();
          // --
          switch ($response['status']) {
              // --
              case 'OK':
                  $data = array();
                  // --
                  foreach ($response['result'] as $item) {
                      // --
                      // --
                      $data[] = array(
                          'id_accesory' => $item['id_accesory'],
                          'accesory_description' => $item['accesory_description'],
                          'accesory_price' => $item['accesory_price'],
                          'accesory_stock' => $item['accesory_stock'],
                          
                      );
                  }
                  // --
                  $json = array(
                      'status' => 'OK',
                      'type' => 'success',
                      'msg' => $this->messages->message['list'],
                      'data' => $data
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

  public function create_accessories() {
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
            !empty($input['accesory_description']) &&
            !empty($input['accesory_price']) &&
            !empty($input['accesory_stock']) 
        ) {
            // --
            
            $accesory_description = $this->functions->clean_string($input['accesory_description']);
            $accesory_price = $this->functions->clean_string($input['accesory_price']);
            $accesory_stock = $this->functions->clean_string($input['accesory_stock']);
            // Save the selected date in a variable
            

            // --
            $bind = array(
                
                'accesory_description' => $accesory_description,
                'accesory_price' => $accesory_price,
                'accesory_stock' => $accesory_stock
            );
            // --
            $obj = $this->load_model('Accessories');
            $response = $obj->create_accessories($bind);
            // --
            switch ($response['status']) {
                // --
                case 'OK':
                    // --
                    $json = array(
                        'status' => 'OK',
                        'type' => 'success',
                        'msg' => 'Accesorio creado en el sistema con éxito.',
                        'data' => array()
                    );
                    // --
                    break;

                case 'ERROR':
                    // --
                    $json = array(
                        'status' => 'ERROR',
                        'type' => 'warning',
                        'msg' => 'No fue posible crear el accesorio ingresado, verificar.',
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
