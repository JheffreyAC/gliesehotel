<?php 
// -- Class Request
class Request {
    
    // --
    private $controller;
    private $method;
    private $arguments;

    // --
    public function __construct() {
        // --
        if (isset($_GET['url'])) {
            // --
            $url = filter_input(INPUT_GET, 'url', FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            if (is_array($url)) {
                $url = array_filter($url);
            }
            // --
            $this->controller = array_shift($url);
            $this->method = array_shift($url);
            $this->arguments = $url;
        }

        // --
        if (!$this->controller) {
            $this->controller = DEFAULT_CONTROLLER;
        }

        // --
        if (!$this->method) {
            $this->method = 'index';
        }

        // --
        if (!isset($this->arguments)) {
            $this->arguments = array();
        }

    }

    // --
    public function get_controller() {
        return $this->controller;
    }

    // --
    public function get_method() {
        return $this->method;
    }

    // --
    public function get_arguments() {
        return $this->arguments;
    }

}
