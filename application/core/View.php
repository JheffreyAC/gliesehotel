<?php 
// -- Class View
class View {
    
    // --
    private $controller;
    private $js;
    private $menu;

    // --
    public function __construct(Request $request) {
        // --
        $this->controller = strtolower($request->get_controller());
        $this->js = array();
        $this->menu = array();
    }

    // --
    public function set_view($view, $partial = false) {
        // --
        $js = array();
        $menu = array();

        if (count($this->js)) {
            $js = $this->js; 
        }

        if (count($this->menu)) {
            $menu = $this->menu; 
        }

        // -- Params
        $params = array(
            'js' => $js,
            'menu' => $menu
		);
        // --
        $route_view = ROOT.'application/views'. DS . $this->controller . DS . $view .'.php';
        // --
        if ($view === 'default') {
            // --
            $route_view = ROOT.'application/views'. DS . $this->controller . DS . 'index' .'.php';
            // --
            if (is_readable($route_view)) {
                include_once $route_view;
            } else {
                throw new Exception('Error of view');
            }
        } else {
            // --
            if (is_readable($route_view)) {
                if (!$partial) {
                    include_once ROOT . 'application/views'. DS . 'main' . DS . DEFAULT_LAYOUT . DS . '01_head.php';
                    include_once ROOT . 'application/views'. DS . 'main' . DS . DEFAULT_LAYOUT . DS . '02_header.php';
                    include_once ROOT . 'application/views'. DS . 'main' . DS . DEFAULT_LAYOUT . DS . '03_menu.php';
                    include_once ROOT . 'application/views'. DS . 'main' . DS . DEFAULT_LAYOUT . DS . '04_information.php';
                    include_once $route_view;
                    include_once ROOT . 'application/views'. DS . 'main' . DS . DEFAULT_LAYOUT . DS . '05_footer.php';
                    include_once ROOT . 'application/views'. DS . 'main' . DS . DEFAULT_LAYOUT . DS . '06_assets.php';
                } else {
                    include_once $route_view;
                }
            } else {
                throw new Exception('Error of view');
            }
        }        
    }

    // --
    public function set_js($js) { 
        // --
        if ($js) {
            $this->js[] = BASE_URL . 'application/views/' . $this->controller . '/js/' . $js . '.js';
		} else {
			throw new Exception('Error of js');
		}
    }

    // --
    public function set_menu($menu) {
        // --
        if ($menu) {
            $this->menu = $menu;
        } else {
            throw new Exception('Error of params');
        }
    }
    
}
