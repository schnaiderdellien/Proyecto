<?php
class Productos {
    private PDO $conexion;

    public function __construct(){
        $this->conexion = Database::getConnection();
    }

    public function getByProduct(): array {
        try{
            $sql = "SELECT * FROM Productos ORDER BY id_productos ASC";
            $stmt = $this->conexion->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }catch (Throwable $e){
            throw $e;
        }
    }
}





?> 