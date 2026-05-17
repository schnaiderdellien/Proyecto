<?php

class UsuarioController extends Controller {

    public function usuarios() {
        try {

            $params = [
                'js'  => 'usuarios.js',
                'rol' => $this->session->getUserLevel()
            ];

            require __DIR__ . '/../templates/usuarios/usuarios.php';

        } catch (Throwable $e) {
            $this->handleError($e);
        }
    }

    public function apiUsuarios() {
        try {

            header('Content-Type: application/json');

            $modelo = new Usuario();

            $usuarios = $modelo->getAll();

            echo json_encode([
                'userLevel' => $this->session->getUserLevel(),
                'data'      => $usuarios
            ]);

        } catch (Throwable $e) {
            $this->handleError($e);
        }
    }

    public function apiRoles() {
        try {
            header('Content-Type: application/json');

            $modelo = new RolesUser();
            $roles = $modelo->getByRole();

            echo json_encode([
                'userLevel' => $this->session->getUserLevel(),
                'data'      => $roles
            ]);
        } catch (Throwable $e) {
            $this->handleError($e);
        }
    }

    public function guardarUsuario() {
        try {

            $modelo = new Usuario();

            $datos = [
                'nombre' => $_POST['nombre'],
                'email' => $_POST['email'],
                'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
                'id_rol' => $_POST['id_rol'],
                'id_estado' => $_POST['id_estado']
            ];
            $modelo->insert($datos);

            header('Location: index.php?ctl=usuarios');
            exit;

        } catch (Throwable $e) {
            $this->handleError($e);
        }
    }

    public function editarUsuario() {
        try {

            $id = $_POST['id_usuario'];

            $modelo = new Usuario();
            $datos = [
                'nombre' => $_POST['nombre'],
                'email' => $_POST['email'],
                'id_rol' => $_POST['id_rol'],
                'id_estado' => $_POST['id_estado']
            ];
            $modelo->update($id, $datos);

            header('Location: index.php?ctl=usuarios');
            exit;

        } catch (Throwable $e) {
            $this->handleError($e);
        }
    }

    public function cambiarPassword() {
    try {

        $params = [
            'js' => 'cambiarPassword.js',
            'rol' => $this->session->getUserLevel()
        ];

        require __DIR__ . '/../templates/usuarios/cambiarPassword.php';

    } catch (Throwable $e) {
        $this->handleError($e);
    }
}

    public function guardarPassword() {
        try {

            $idUsuario = $this->session->getUserId();

            $passwordActual = $_POST['password_actual'];
            $passwordNueva = $_POST['password_nueva'];
            $passwordConfirmar = $_POST['password_confirmar'];

            if ($passwordNueva !== $passwordConfirmar) {
                throw new Exception('Las contraseñas no coinciden');
            }

            $modelo = new Usuario();

            $usuario = $modelo->getById($idUsuario);

            if (!$usuario) {
                throw new Exception('Usuario no encontrado');
            }

            if (!password_verify($passwordActual, $usuario['password'])) {
                throw new Exception('La contraseña actual es incorrecta');
            }

            $passwordHash = password_hash($passwordNueva, PASSWORD_DEFAULT);

            $modelo->updatePassword($idUsuario, $passwordHash);

            header('Location: index.php?ctl=cambiarPassword');
            exit;

        } catch (Throwable $e) {
            $this->handleError($e);
        }
    }

    public function olvidePassword() {

        try {

            $params = [
                'rol' => 0
            ];

            require __DIR__ . '/../templates/usuarios/olvidePassword.php';

        } catch (Throwable $e) {

            $this->handleError($e);

        }
    }

    public function resetearPassword() {

        try {

            $idUsuario = $_POST['id_usuario'];

            $passwordNueva = $_POST['password_nueva'];

            $passwordHash = password_hash($passwordNueva, PASSWORD_DEFAULT);

            $modelo = new Usuario();

            $modelo->updatePassword($idUsuario, $passwordHash);

            header('Location: index.php?ctl=usuarios');
            exit;

        } catch (Throwable $e) {

            $this->handleError($e);

        }
    }

    

}