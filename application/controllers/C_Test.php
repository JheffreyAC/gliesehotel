 <?php 
// --
class C_Test extends Controller {

    // --
    public function __construct() {
		parent::__construct();
    }
    
    // --
    public function index() {
        // --
        $this->functions->validate_session($this->segment->get('isActive'));
        $this->functions->check_permissions($this->segment->get('modules'), 'Income');
        // --
        $this->view->set_js('index');       // -- Load JS
        $this->view->set_menu(array('modules' => $this->segment->get('modules'), 'view' => 'Income')); // -- Active Menu
        $this->view->set_view('index');     // -- Load View
    }

    // --
    public function create_income() {
        // --
        $this->functions->validate_session($this->segment->get('isActive'));
        // --
        $request = $_SERVER['REQUEST_METHOD'];
        // --
        if ($request === 'POST') {
            // --
            $input = json_decode(file_get_contents('php://input'), true);
            if (empty($input)) {
                $input = filter_input_array(INPUT_POST);
            }
            // --
            if (!empty($input['business_name']) &&
                !empty($input['vt_description']) &&
                !empty($input['pt_description']) &&
                !empty($input['first_name']) &&
                !empty($input['proof_date']) &&
                !empty($input['proof_series']) &&
                !empty($input['voucher_series']) &&
                !empty($input['igv']) &&
                !empty($input['number_installments']) &&
                !empty($input['installment_value']) &&
                !empty($input['full_purchase']) 
            ) {
                // --
                $business_name = $this->functions->clean_string($input['business_name']);
                $voucher_type_description = $this->functions->clean_string($input['vt_description']);
                $payment_type_description = $this->functions->clean_string($input['pt_description']);
                $first_name = $this->functions->clean_string(strtoupper($input['first_name']));
                $proof_date = $this->functions->clean_string($input['proof_date']);
                $proof_series = $this->functions->clean_string($input['proof_series']);
                $voucher_series = $this->functions->clean_string($input['voucher_series']);
                $igv = $this->functions->clean_string($input['igv']);
                $number_installments = $this->functions->clean_string($input['number_installments']);
                $installment_value = $this->functions->clean_string($input['installment_value']);
                $full_purchase = $this->functions->clean_string($input['full_purchase']);
                // --
                $bind = array(
                    'business_name' => $business_name,
                    'vt_description' => $voucher_type_description,
                    'pt_description' => $payment_type_description,
                    'first_name' => $first_name,
                    'proof_date' => $proof_date,
                    'proof_series' => $proof_series,
                    'voucher_series' => $voucher_series,
                    'igv' => $igv,
                    'number_installments' => $number_installments,
                    'installment_value' => $installment_value,
                    'full_purchase' => $full_purchase,
                );
                // --
                $obj = $this->load_model('Income');
                $response = $obj->create_income($bind);
                // --
                switch ($response['status']) {
                    // --
                    case 'OK':
                        // --
                        $json = array(
                            'status' => 'OK',
                            'type' => 'success',
                            'msg' => 'Registro almacenado en el sistema con éxito.',
                            // 'msg' => ,
                            'data' => array()
                        );
                        // --
                        break;

                    case 'ERROR':
                        // --
                        $json = array(
                            'status' => 'ERROR',
                            'type' => 'warning',
                            'msg' => 'No fue posible guardar el registro ingresado, verificar.',
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
                    'type' => 'warning',
                    'msg' => 'No se enviaron los campos necesarios, verificar.',
                    'data' => array()
                );
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