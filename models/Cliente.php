<?php

include_once 'config/database.php';

class Cliente
{
    private $conexion;

    public function __construct()
    {
        $database = new Database();
        $this->conexion = $database->conectar();
    }

     public function guardar($nombre, $ciudad, $dirreccion, $telefono, $email, $descripcion, $categoria, $hora_checkin, $hora_checkout, $disponible)
    {
        if (!$this->conexion) {
            return false;
        }

        $sql = "INSERT INTO clientes (camposBD..) VALUES (parmsReferencia)";
        $consulta = $this->conexion->prepare($sql);
        //bindParams
        $consulta->bindParam(':nombre', $nombre);

        $consulta->execute();
        $idCliente = $this->conexion->lastInsertId();
        //Regresar el idCliente nuevo
        return (int) $idCliente;
    }

}
