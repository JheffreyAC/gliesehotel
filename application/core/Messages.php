<?php 
// -- Class Messages
class Messages {
    // --
    public $message = array();

    // --
    public function __construct() {
        // --
        $this->message = array(
            // -- List
            'list' => 'Listado de registros encontrados.',
            'emtpy_list' => 'No se encontraron registros en el sistema.',
            // -- Success
            'success_created' => 'Registro almacenado en el sistema con éxito.',
            'success_updated' => 'Registro actualizado en el sistema con éxito.',
            'success_deleted' => 'Registro eliminado del sistema con éxito.',
            // -- Error
            'error_created' => 'No fue posible almacenar el registro ingresado, verificar.',
            'error_updated' => 'No fue posible actualizar el registro ingresado, verificar.',
            'error_deleted' => 'No fue posible eliminar el registro, verificar.',
            // -- Empty Params
            'empty_params' => 'No se enviaron los campos necesarios, verificar.',
            // -- Method
            'method_denied' => 'Método no permitido.',
        );
    }
}