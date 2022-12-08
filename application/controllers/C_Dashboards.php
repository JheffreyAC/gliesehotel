<?php 
// --
class C_Dashboards extends Controller { 

    // --
    public function __construct() {
		parent::__construct();
    }
    
    // --
    public function index() {
        // --
        $this->functions->validate_session($this->segment->get('isActive'));
        $this->functions->check_permissions($this->segment->get('modules'), 'Dashboards');
        // --
        $this->view->set_js('index');       // -- Load JS
        $this->view->set_menu(array('modules' => $this->segment->get('modules'), 'view' => 'Dashboards')); // -- Active Menu
        $this->view->set_view('index');     // -- Load View
    }

    // --
    public function get_dashboard() {
        // --
        $json = array(
            'data' => $this->segment->get('data')
        );
        // --
        header('Content-Type: application/json');
        echo json_encode($json);
    }
    
}