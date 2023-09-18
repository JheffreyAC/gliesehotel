<?php 
// --
class C_Food extends Controller {

    // --
    public function __construct() {
		parent::__construct();
    }
    
    // --
    public function index() {
        // --
        $this->functions->validate_session($this->segment->get('isActive'));
        $this->functions->check_permissions($this->segment->get('modules'), 'Food');
        // --
        $this->view->set_js('index');       // -- Load JS
        $this->view->set_menu(array('modules' => $this->segment->get('modules'), 'view' => 'Food')); // -- Active Menu
        $this->view->set_view('index');     // -- Load View
    }
    public function get_food() { 
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
          $obj = $this->load_model('Food');
          // --
          $response = $obj->get_food();
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
                          'id_food' => $item['id_food'],
                          'food_description' => $item['food_description'],
                          'food_price' => $item['food_price'],
                          'food_stock' => $item['food_stock'],
                          'tipo_food' => $item['tipo_food'],
                          
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
}
