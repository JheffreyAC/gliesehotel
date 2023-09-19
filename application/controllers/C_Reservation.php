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
          $obj = $this->load_model('Roles');
          // --
          $response = $obj->get_roles();
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
                          'id_reservation' => $item['id_reservation'],
                          'checkin_date' => $item['checkin_date'],
                          'checkout_date' => $item['checkout_date'],
                          'id_room' => $item['id_room'],
                          'id_guest' => $item['id_guest']
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

}