<?php 
// -- Class Bootstrap
class Bootstrap {
    // --
    public static function run(Request $request) {
        // --
        $controller = 'C_' . $request->get_controller();
        $route_controller = ROOT . 'application'. DS .'controllers' . DS . $controller . '.php';  // Example:  .../controllers/C_Login.php
        $method = $request->get_method();
        $arguments = $request->get_arguments();

        // --
        if (is_readable($route_controller)) {
            // --
            require_once $route_controller;
            $controller = new $controller;
            // --
            if (is_callable(array($controller, $method))) {
                $method = $request->get_method();
            } else {
                $method = 'index';
            }
            // --
            if (isset($arguments)) {
                call_user_func_array(array($controller, $method), $arguments);
            } else {
                call_user_func(array($controller, $method));
            }
            
        } else {
            throw new Exception('Not found');
        }
    }
}
