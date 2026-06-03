<?php

class AuthController extends Controller {

    public function login (){

        ini_set('display_errors', 1);
        error_reporting(E_ALL);

        try{
            if($_SERVER['REQUEST_METHOD'] === 'POST'){
                
                $email = $_POST['email'] ?? '';
                $password = $_POST['password'] ?? '';

                $userModel = new User();
                $usuario = $userModel->findByEmail($email);

                if($usuario &&  $usuario ['id_estado'] == 1 && password_verify($password,$usuario['password'])){
                    //guardamos la sesión
                    $this->session->login(
                        $usuario['id_usuario'],
                        $usuario['nombre'],
                        $usuario['id_rol']
                    );

                    //Actualizamos el último login
                    $userModel->updateLastLogin($usuario['id_usuario']);

                    header ('Location: index.php?ctl=dashboard');
                    exit;
                }

                $error = "Credenciales incorrectas";
            }


            require __DIR__ . '/../templates/login.php';
        } catch (Throwable $e){
            $this->handleError($e);
        }
    }
    public function logout (){
        $this->session->logout();
    }
}


?>