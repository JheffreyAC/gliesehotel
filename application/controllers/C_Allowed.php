<?php 
// --
class C_Allowed extends Controller {

    // --
    public function __construct() {
		parent::__construct();
    }
    
    // --
    public function index() {
        // -- 
        $this->functions->validate_session($this->segment->get('isActive'));
        $this->view->set_js('index');
        $this->view->set_view('default');
    }
}