<?php 
// --
class C_Clients extends Controller {

  // --
  public function __construct() {
   parent::__construct();
  }

  // --
  public function index() {
      // --
      $this->functions->validate_session($this->segment->get('isActive'));
      $this->functions->check_permissions($this->segment->get('modules'), 'Clients');
      // --
      $this->view->set_js('index');       // -- Load JS
      $this->view->set_menu(array('modules' => $this->segment->get('modules'), 'view' => 'Clients')); // -- Active Menu
      $this->view->set_view('index');     // -- Load View
  }

  // --
  public function get_clients() { 
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
        $obj = $this->load_model('Clients');
        // --
        $response = $obj->get_clients();
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
  public function get_client_by_id() {
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
        if (!empty($input['id_clients'])) {
            // --
            $obj = $this->load_model('Clients');
            // --
            $bind = array(
                'id_clients' => intval($input['id_clients']));
            // --
            $response = $obj->get_client_by_id($bind);
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
  public function create_clients() {
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
              !empty($input['email']) &&
              !empty($input['description_document_type'])
          ) {
              // --
              $document_type = $this->functions->clean_string($input['document_type']);
              $name = $this->functions->clean_string(strtoupper(ucfirst($input['name'])));
              $document_number = $this->functions->clean_string($input['document_number']);
              $description_document_type = $this->functions->clean_string($input['description_document_type']);
              $address = $this->functions->clean_string($input['address']);
              $phone = $this->functions->clean_string($input['phone']);
              $business_name = $this->functions->clean_string($input['business_name']); 
              $email = $this->functions->clean_string($input['email']);
              // --
              $is_verified = $this->functions->verified_document_type($description_document_type, $document_number); // -- verified document type
              // --
              if ($is_verified) {
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
                  $obj = $this->load_model('Clients');
                  $response = $obj->create_clients($bind);
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
  public function update_clients() {
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
        if (!empty($input['id_clients']) && 
            !empty($input['document_type']) && 
            !empty($input['name']) &&
            !empty($input['document_number']) &&
            !empty($input['address']) &&
            !empty($input['phone'])&&
            !empty($input['business_name']) &&
            !empty($input['email']) &&
            !empty($input['description_document_type'])
        ) {
            // --
            $id_clients = $this->functions->clean_string($input['id_clients']);
            $document_type = $this->functions->clean_string($input['document_type']);
            $name = $this->functions->clean_string(strtoupper(ucfirst($input['name'])));
            $document_number = $this->functions->clean_string($input['document_number']);
            $description_document_type = $this->functions->clean_string($input['description_document_type']);   
            $address = $this->functions->clean_string($input['address']);
            $phone = $this->functions->clean_string($input['phone']);
            $business_name = $this->functions->clean_string($input['business_name']);
            $email = $this->functions->clean_string($input['email']);
            // --
            $is_verified = $this->functions->verified_document_type($description_document_type, $document_number); // -- verified document type
            // --
            if ($is_verified) {
                // -- 
                $bind = array(
                    'id_clients' => $id_clients,
                    'id_document_type' => $document_type,
                    'name' => $name,
                    'document_number' => $document_number,
                    'address' => $address,
                    'phone' => $phone,
                    'business_name' => $business_name,
                    'email' => $email

                );
                // --
                $obj = $this->load_model('Clients');
                $response = $obj->update_clients($bind);
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
            'data' => array()
        ); 
    }


    // --
    header('Content-Type: application/json');
    echo json_encode($json);
  }
  
  // --
  public function delete_clients() {
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
        if (!empty($input['id_clients'])) {
            // --
            $id_clients = $this->functions->clean_string($input['id_clients']);
            // --
            $bind = array(
                'id_clients' => $id_clients
            );
            // --
            $obj = $this->load_model('Clients');
            $response = $obj->delete_clients($bind);
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

   //--
   public function get_business_name() {
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
        $obj = $this->load_model('Clients');
        // --
        $response = $obj->get_business_name();
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


}