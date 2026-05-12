<?php

class MetodosPago {

    private PDO $conexion;

    public function __construct(){
        $this->conexion = Database::getConnection();
    }

    public function getByPagos(): array {

    try{
        $sql = "SELECT id_metodo_pago, metodo_pago FROM Metodo_pago ";
        $stmt = $this->conexion->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        
    }catch(Throwable $e){
    throw $e;
    }

    }
}







?>