<?php
class InicioController extends Controller{
   
   
    public function inicio()
    {

        $params = array(
            'mensaje' => 'CRM',
            'mensaje2' => 'Sistema de gestión de negocios',
            'fecha' => date('d-m-Y'),
            //'pass' =>  password_hash("1234", PASSWORD_DEFAULT)
        );
        

        require __DIR__ . '/../templates/inicio.php';
    }
}
