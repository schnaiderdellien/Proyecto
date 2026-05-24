<?php

class Usuario {

    private PDO $conexion;

    public function __construct() {
        $this->conexion = Database::getConnection();
    }
    // Método para obtener todos los usuarios

    public function getAll(): array {

        $sql = "SELECT u.*, r.rol AS rol_nombre FROM Usuarios u LEFT JOIN Rol r ON u.id_rol = r.id_rol ORDER BY u.id_usuario ASC";

        $stmt = $this->conexion->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Método para obtener un usuario por su ID

    public function insert(array $datos): void {

        $sql = "INSERT INTO usuarios (
                    nombre,
                    email,
                    password,
                    id_rol,
                    fecha_alta,
                    id_estado
                ) VALUES (
                    :nombre,
                    :email,
                    :password,
                    :id_rol,
                    :fecha_alta,
                    :id_estado
                )";

        $stmt = $this->conexion->prepare($sql);

        $stmt->execute([
            ':nombre'   => $datos['nombre'],
            ':email'    => $datos['email'],
            ':password' => password_hash($datos['password'], PASSWORD_DEFAULT),
            ':id_rol'   => $datos['id_rol'],
            ':fecha_alta' => date('Y-m-d H:i:s'),
            ':id_estado'   => $datos['id_estado']
        ]);
    }
    // Método para actualizar un usuario existente

    public function update(int $id, array $datos): void {

        $sql = "UPDATE usuarios SET
                    nombre = :nombre,
                    email = :email,
                    id_rol = :id_rol,
                    id_estado = :id_estado
                WHERE id_usuario = :id";

        $stmt = $this->conexion->prepare($sql);

        $stmt->execute([
            ':nombre' => $datos['nombre'],
            ':email'  => $datos['email'],
            ':id_rol' => $datos['id_rol'],
            ':id_estado' => $datos['id_estado'],
            ':id'     => $id
        ]);
    }

    public function getById(int $id): array|false {

    $sql = "SELECT * FROM Usuarios WHERE id_usuario = :id";

    $stmt = $this->conexion->prepare($sql);

    $stmt->execute([
        ':id' => $id
    ]);

    return $stmt->fetch(PDO::FETCH_ASSOC);
    

    }


    // Método para cambiar la contraseña de un usuario
    public function updatePassword(int $idUsuario, string $password): void {

        $sql = "UPDATE usuarios
                SET password = :password
                WHERE id_usuario = :id_usuario";

        $stmt = $this->conexion->prepare($sql);

        $stmt->execute([
            ':password' => $password,
            ':id_usuario' => $idUsuario
        ]);
    }
    
}

