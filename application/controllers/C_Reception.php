<?php
// --
class C_Reception extends Controller
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
    $this->functions->check_permissions($this->segment->get('modules'), 'Reception');
    // --
    $this->view->set_js('index');       // -- Load JS
    $this->view->set_menu(array('modules' => $this->segment->get('modules'), 'view' => 'Reception')); // -- Active Menu
    $this->view->set_view('index');     // -- Load View  
  }
  public function get_rooms()
  {
    $this->functions->validate_session($this->segment->get('isActive'));
    $request = $_SERVER['REQUEST_METHOD'];

    if ($request === 'GET') {
      $input = json_decode(file_get_contents('php://input'), true);
      if (empty($input)) {
        $input = filter_input_array(INPUT_GET);
      }

      $obj = $this->load_model('Reception');
      $response = $obj->get_rooms();

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
}
