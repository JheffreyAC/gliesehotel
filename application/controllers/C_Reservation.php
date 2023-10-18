<?php 
// --
class C_Reservation extends Controller {

    // --
    public function __construct() {
		parent::__construct();
    }
    
    // --
    public function index() {
        // --
        $this->functions->validate_session($this->segment->get('isActive'));
        $this->functions->check_permissions($this->segment->get('modules'), 'Reservation');
        // --
        $this->view->set_js('index');       // -- Load JS
        $this->view->set_menu(array('modules' => $this->segment->get('modules'), 'view' => 'Reservation')); // -- Active Menu
        $this->view->set_view('index');     // -- Load View
    }

    // --
    public function get_reservations() { 
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
            $obj = $this->load_model('Reservation');
          // --
            $response = $obj->get_reservations();
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
                            'id_reservation' => $item['id_reservation'],
                            'checkin_date' => $item['checkin_date'],
                            'checkin_time' => $item['checkin_time'],
                            'checkout_date' => $item['checkout_date'],
                            'checkout_time' => $item['checkout_time'],
                            'room_number' => $item['room_number'],
                            'room_status' => $item['room_status'],
                            'type_name' => $item['type_name'],
                            'bed_type' => $item['bed_type'],
                            'document_type' => $item['document_type'],
                            'document_number' => $item['document_number'],
                            'first_names' => $item['first_names'],
                            'last_names' => $item['last_names'],
                            'company_name' => $item['company_name']
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

    // --
    public function get_reservation() {
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
            if (!empty($input['id_reservation'])) {
              // --
                $obj = $this->load_model('Reservation');
              // --
                $bind = array(
                    'id_reservation' => intval($input['id_reservation']));
              // --
                $response = $obj->get_reservation($bind);
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

public function get_sales_food() {
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
        if (!empty($input['id_reservation'])) {
            // --
            $obj = $this->load_model('Reservation');
            // --
            $bind = array(
                'id_reservation' => intval($input['id_reservation']));
            // --
            $response = $obj->get_sales_food($bind);
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

public function get_sales_accessory() {
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
      if (!empty($input['id_reservation'])) {
          // --
          $obj = $this->load_model('Reservation');
          // --
          $bind = array(
              'id_reservation' => intval($input['id_reservation']));
          // --
          $response = $obj->get_sales_accessory($bind);
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
public function update_reservation() {
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
        if (!empty($input['id_reservation']) &&
            !empty($input['id_room'])
        ) {
            // --
            $id_reservation = $input['id_reservation'];
            $id_room = $input['id_room'];

            // $description = strtoupper($this->functions->clean_string($input['description']));
            // --
            $bind = array(
                'id_reservation' => $id_reservation,
                'id_room' => $id_room,
                'timestamp_updated' => time()
            );
            // --
            $obj = $this->load_model('Reservation');
            $response = $obj->update_reservation($bind);
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


}
