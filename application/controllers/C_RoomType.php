<?php
// --
class C_Roomtype extends Controller
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
    $this->functions->check_permissions($this->segment->get('modules'), 'Roomtype');
    // --
    $this->view->set_js('index');       // -- Load JS
    $this->view->set_menu(array('modules' => $this->segment->get('modules'), 'view' => 'Roomtype')); // -- Active Menu
    $this->view->set_view('index');     // -- Load View
  }
  public function get_room_types()
  {
    $this->functions->validate_session($this->segment->get('isActive'));
    $request = $_SERVER['REQUEST_METHOD'];

    if ($request === 'GET') {
      $input = json_decode(file_get_contents('php://input'), true);
      if (empty($input)) {
        $input = filter_input_array(INPUT_GET);
      }

      $obj = $this->load_model('RoomType');
      $response = $obj->get_room_types();

      switch ($response['status']) {
        case 'OK':
          $json = array(
            'status' => 'OK',
            'type' => 'success',
            'msg' => 'Listado de registros encontrados.',
            'data' => $response['result']
          );
          break;

        case 'ERROR':
          $json = array(
            'status' => 'ERROR',
            'type' => 'warning',
            'msg' => 'No se encontraron registros en el sistema.',
            'data' => array(),
          );
          break;

        case 'EXCEPTION':
          $json = array(
            'status' => 'ERROR',
            'type' => 'error',
            'msg' => $response['result']->getMessage(),
            'data' => array()
          );
          break;
      }
    } else {
      $json = array(
        'status' => 'ERROR',
        'type' => 'error',
        'msg' => 'Método no permitido.',
        'data' => array()
      );
    }

    header('Content-Type: application/json');
    echo json_encode($json);
  }



  //--



  public function create_room_types()
  {
    $this->functions->validate_session($this->segment->get('isActive'));
    $request = $_SERVER['REQUEST_METHOD'];

    if ($request === 'POST') {
      // Recibir los datos de las habitaciones desde la solicitud
      $input = json_decode(file_get_contents('php://input'), true);
      if (empty($input)) {
        $input = filter_input_array(INPUT_POST);
      }

      // Verificar si los datos necesarios están presentes en la solicitud
      if (
        !empty($input['type_name']) &&
        !empty($input['person_limit']) &&
        !empty($input['bed_type']) &&
        !empty($input['price_temporary']) &&
        !empty($input['price_half']) &&
        !empty($input['price_day'])
      ) {
        // Realizar validaciones si es necesario

        // Crear un arreglo de datos para la inserción en la base de datos
        $bind = array(
          'type_name' => $input['type_name'],
          'person_limit' => $input['person_limit'],
          'bed_type' => $input['bed_type'],
          'price_temporary' => $input['price_temporary'],
          'price_half' => $input['price_half'],
          'price_day' => $input['price_day'],
          // Agregar otros campos si es necesario
        );

        // Llamar a la función que crea la habitación en el modelo correspondiente
        $obj = $this->load_model('RoomType');
        $response = $obj->create_room_types($bind);

        switch ($response['status']) {
          case 'OK':
            $json = array(
              'status' => 'OK',
              'type' => 'success',
              'msg' => 'Tipo de Habitación creada en el sistema con éxito.',
              'data' => array()
            );
            break;

          case 'ERROR':
            $json = array(
              'status' => 'ERROR',
              'type' => 'warning',
              'msg' => 'No fue posible crear la habitación ingresada, verificar.',
              'data' => array(),
            );
            break;

          case 'EXCEPTION':
            $json = array(
              'status' => 'ERROR',
              'type' => 'error',
              'msg' => $response['result']->getMessage(),
              'data' => array()
            );
            break;
        }
      } else {
        $json = array(
          'status' => 'ERROR',
          'type' => 'warning',
          'msg' => 'No se enviaron los campos necesarios, verificar.',
          'data' => array()
        );
      }
    } else {
      $json = array(
        'status' => 'ERROR',
        'type' => 'error',
        'msg' => 'Método no permitido.',
        'data' => array()
      );
    }

    header('Content-Type: application/json');
    echo json_encode($json);
  }
}
