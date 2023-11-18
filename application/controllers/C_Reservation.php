<?php
// --
class C_Reservation extends Controller
{

  // --
  public function __construct()
  {
    parent::__construct();
  }

  // --
  public function index()
  {
    // --
    $this->functions->validate_session($this->segment->get('isActive'));
    $this->functions->check_permissions($this->segment->get('modules'), 'Reservation');
    // --
    $this->view->set_js('index');       // -- Load JS
    $this->view->set_menu(array('modules' => $this->segment->get('modules'), 'view' => 'Reservation')); // -- Active Menu
    $this->view->set_view('index');     // -- Load View
  }

  // --
  public function get_reservations()
  {
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
              'person_limit' => $item['person_limit'],
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
  public function get_reservation()
  {
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
          'id_reservation' => intval($input['id_reservation'])
        );
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

  public function get_sales_food()
  {
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
          'id_reservation' => intval($input['id_reservation'])
        );
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

  public function get_sales_accessory()
  {
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
          'id_reservation' => intval($input['id_reservation'])
        );
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

  public function get_payment_extra()
  {
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
      $response = $obj->get_payment_extra();
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
              'extra_time' => $item['extra_time'],
              'price_extra' => $item['price_extra']
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

  public function update_reservation()
  {
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
        !empty($input['id_reservation']) &&
        !empty($input['id_room']) &&
        !empty($input['id_payment']) &&
        !empty($input['checkin_date']) &&
        !empty($input['checkout_date']) &&
        !empty($input['checkin_time']) &&
        !empty($input['checkout_time']) &&
        !empty($input['payment_room'])
      ) {
        // --
        $id_room = $this->functions->clean_string($input['id_room']);
        $id_reservation = $this->functions->clean_string($input['id_reservation']);
        $id_payment = $this->functions->clean_string($input['id_payment']);
        $checkin_date = $this->functions->clean_string($input['checkin_date']);
        $checkout_date = $this->functions->clean_string($input['checkout_date']);
        $checkin_time = $this->functions->clean_string($input['checkin_time']);
        $checkout_time = $this->functions->clean_string($input['checkout_time']);
        $payment_room = $this->functions->clean_string($input['payment_room']);
        // --
        $bind = array(
          'id_room' => $id_room,
          'id_reservation' => $id_reservation,
          'id_payment' => $id_payment,
          'payment_room' => $payment_room,
          'checkin_date' => $checkin_date,
          'checkout_date' => $checkout_date,
          'checkin_time' => $checkin_time,
          'checkout_time' => $checkout_time
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
