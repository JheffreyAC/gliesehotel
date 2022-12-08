<?php 
// -- Libraries
require APP_VENDOR . 'autoload.php';

// -- Class Controller
abstract class Controller {
    
    // -- View
    protected $view;
    // -- Functions
    protected $functions;
    // -- Session
    protected $session;
    // -- Segment
    protected $segment;
    // -- Messages
    protected $messages;

    // -- Construct
    public function __construct() {
        // -- 
        $this->view = new View(new Request);
        $this->functions = new Functions();
        $this->messages = new Messages();
        // --
        $session_factory = new \Aura\Session\SessionFactory;
        $session = $session_factory->newInstance($_COOKIE);
        $session->setCookieParams(array('lifetime' => '3600')); // -- 36000 Seconds -> 10 Hours
        // --
        $this->session = $session;
        $this->segment = $session->getSegment('teg\gliese');
    }

    // --
    abstract public function index();

    // --
    public function load_model($model) {
        // --
        $model = 'M_' . $model; // -- Example -> M_Dashboards
        $route_model = ROOT . 'application'. DS .'models' . DS .$model . '.php';

        // --
        if (is_readable($route_model)) {
            // --
			require_once $route_model;
			$model = new $model;
			return $model;
		} else {
			throw new Exception('Error of model');
		}
    }

}
