<?php
// --
class C_Menu extends Controller {

    // --
    public function __construct() {
		parent::__construct();
    }
    
    // --
    public function index() {
        // --
        $this->functions->validate_session($this->segment->get('isActive'));
    }

    // --
    public function get_menu() {
        // --
        $this->functions->validate_session($this->segment->get('isActive'));
        // --
        $request = $_SERVER['REQUEST_METHOD'];
        // --
        if ($request === 'GET') {
            // --
            $obj = $this->load_model('Menu');
            // --
            $response = $obj->get_menu();
            // --
            switch ($response['status']) {
                // --
                case 'OK':
                    // --
                    $group_menu = array();
                    // --
                    foreach ($response['result'] as $item) {
                        $group_menu[$item['id_menu']][] = $item;
                    }
                    // --
                    $menu = array();
                    $index = 0;
                    // --
                    foreach ($group_menu as $item) {
                        // --
                        foreach ($item as $row) {
                            // --
                            $menu[$index]['id'] = $row['id_menu'];
                            $menu[$index]['description'] = $row['description_menu'];
                            $menu[$index]['icon'] = $row['icon_menu'];
                            $menu[$index]['order'] = $row['order_menu'];
                            // --
                            $menu[$index]['sub_menu'][] = array(
                                'id' => $row['id_sub_menu'],
                                'description' => $row['description_sub_menu'],
                                'icon' => $row['icon_sub_menu'],
                                'url' => $row['url_sub_menu'],
                                'order' => $row['order_sub_menu']
                            );
                        }
                        // --
                        $index++;
                    }
                    // --
                    $json = array(
                        'status' => 'OK',
                        'type' => 'success',
                        'msg' => 'Listado de registros encontrados.',
                        'data' => $menu
                    );
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
                'msg' => 'Método no permitido.'
            ); 
        }

        // --
        header('Content-Type: application/json');
        echo json_encode($json);
    }
    
}