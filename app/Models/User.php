<?php

class User{
    private PDO $conexion;

    public function __construct(){
        $this->conexion = Database::getConnection();

    }

    //Consula del correo electrónico del usuario

    public function findByEmail(string $email): ?array{
        
            $sql = "SELECT * FROM usuarios WHERE email = :email LIMIT 1";
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute([':email'=>$email]);
            
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            return $result ?:null;

        
    }

    //Para actualizar la fecha de su último login

    public function updateLastLogin(int $id): void {
        
        $sql = "UPDATE usuarios SET ultimo_login = NOW() WHERE id_usuario = :id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute(['id'=>$id]);
    }
}


?>