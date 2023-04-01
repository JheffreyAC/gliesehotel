<?php 
// -- Libraries
require APP_VENDOR . 'autoload.php';
// --
use \Firebase\JWT\JWT;
use \Luecano\NumeroALetras\NumeroALetras;
use \Spipu\Html2Pdf\Html2Pdf;
use \PHPMailer\PHPMailer\PHPMailer;

// -- Class Functions
class Functions {
    /**
     * Encrypt Password
     */
    public function encrypt_password($string) {
        // --
        $salt = '$6$rOuNdS=75fd3@15f%9f&ds8$s@l/$';
        $data = bin2hex(base64_encode(md5(crypt($string, $salt))));
        // --
        return $data;
    }

    /**
     * Encrypt code in hexadecimal and base64
     */
    public function encrypt_hex64($string) {
        // --
        $code_one = random_bytes(20);
        $code_two = base64_encode($string);
        $code = bin2hex(base64_encode($code_one.$code_two));
        // --
        return $code;
    }

    /**
     * Decrypt code in hexadecimal and base64
     */
    public function decrypt_hex64($string) {
        // --
        $code = hex2bin($string);
        $code = base64_decode($code);
        $code = substr($code, 20);
        $code = base64_decode($code);
        // --
        return $code;
    }

    /**
     * Encrypt code in hexadecimal and base64 For JS
     */
    public function encrypt_hex64JS($string) {
        // --
        $code = bin2hex(base64_encode($string));
        // --
        return $code;
    }

    /**
     * Decrypt code in hexadecimal and base64 For JS
     */
    public function decrypt_hex64JS($string) {
        // --
        $code = hex2bin(base64_decode($string));
        // --
        return $code;
    }

    /**
     * Validate if the session is active
     */
    public function validate_session($val) {
        // --
        if (!$val) {
            header('Location: ' . BASE_URL);
            die();
            exit();
        }
    }

    /**
     * Check if the session is active
     */
    public function check_session($val) {
        // --
        if ($val) {
            header('Location: ' . BASE_URL . 'Dashboards');
        }
    }

    /**
     * Check if you have permission for this view
     */
    public function check_permissions($permissions, $view) {
        // --
        $status = false;
        // --
        foreach ($permissions as $menu) {
            // --
            foreach ($menu['sub_menu'] as $sub_menu) {
                // --
                if (trim(strtolower($sub_menu['url'])) === strtolower($view)) {
                    $status = true;
                }
            }
        }
        // --
        if (!$status) {
            header('Location: ' . BASE_URL . 'Allowed');
        }
    }

    /**
     * Exit App
     */
     public function exit_app() {
        // --
        header('Location: ' . BASE_URL);
        die();
        exit();
     }


    /**
     * Clean String
     */
    public function clean_string($string) {
        // --
        $string = trim($string);
        $string = strip_tags($string);
        $string = htmlspecialchars($string); 
        // --
        return $string;
    }

    /**
     * Validate Length
     */
    public function verified_document_type($document_type, $document_number) {
        // -- validar por tipo de documento (step 1)
        // -- validar longitud por tipo de docuento
        /**
         * dni -> 8
         * ce -> 20
         * ruc -> 11
         */

        $count = strlen($document_number);
        // --
        switch ($document_type) {
        case 'DNI':
            // --
            if ($count === 8) {
                return true;
            }
            // --
            break;

        case 'RUC':
            // --
            if ($count === 11) {
                return true;
            }
            // --
            break;

        default:
            // --
            break;
        }
        // --
        return false;
    }


    /**
     * Calculate distance between geographical points
     */
    function distance($lat1, $lon1, $lat2, $lon2, $unit = "M") {
        // --
        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $unit = strtoupper($unit);
        // --
        if ($unit == "K") {
            return ($miles * 1.609344);
        } else if ($unit == "N") {
            return ($miles * 0.8684);
        } else if ($unit == "M") {
            return ($miles * 1.609344) * 1000;
        } else {
            return $miles;
        }
    }

    /**
     * Group an array by key
     */
    function group_array($array, $groupkey) {
        // --
        if (count($array) > 0) {
            // --
            $keys = array_keys($array[0]);
            $removekey = array_search($groupkey, $keys);
            if ($removekey === false)
                return array("Clave \"$groupkey\" no existe");
            else
                unset($keys[$removekey]);
            $groupcriteria = array();
            $return = array();
            foreach ($array as $value) {
                $item = null;
                foreach ($keys as $key) {
                    $item[$key] = $value[$key];
                }
                $busca = array_search($value[$groupkey], $groupcriteria);
                if ($busca === false) {
                    $groupcriteria[] = $value[$groupkey];
                    $return[] = array(
                        $groupkey => $value[$groupkey], 
                        'groupdata' => array()
                    );
                    $busca = count($return) - 1;
                }
                $return[$busca]['groupdata'][] = $item;
            }
            return $return;
        } else {
            return array();
        } 
    }


    /**
     * Remove duplicate array
     */
    function unique_multidim_array($array, $key) {
        // --
        $temp_array = array();
        $i = 0;
        $key_array = array();
        // --
        foreach($array as $val) {
            if (!in_array($val[$key], $key_array)) {
                $key_array[$i] = $val[$key];
                $temp_array[$i] = $val;
            }
            $i++;
        }
        // --
        return $temp_array;
    }

    /**
     * Transform numbers to letters
     */
    function number_to_letters($number, $currency) {
        // --
        $numberToLetters = NumeroALetras::convert($number, $currency);
        // --
        return $numberToLetters;
    }

    /**
     * Create PDF
     */
    function create_pdf($html) {
        // --
        $html2pdf = new Html2Pdf('P', 'A4', 'es');
		$html2pdf->writeHTML($html);
        $html2pdf->output('OrdenDePedido.pdf');
        // --
        $document = $html2pdf->Output('OrdenDePedido.pdf', 'S');
        return $document;
    }

    /**
     * Send email
     */
    function send_email($attached, $address) {
        // --
        $mail = new PHPMailer(true);
        // --
        try {
            // --
            $mail->From = 'email';
            $mail->FromName = 'name';
            $mail->Subject = 'asunto';
            $mail->Body = 'Se adjunta la orden en PDF.';
            $mail->addAddress($address);
            // -- 
            $mail->addStringAttachment($attached, 'OrdenDePedido.pdf', 'base64', 'application/pdf');
            //  -- 
            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            // -- 
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}