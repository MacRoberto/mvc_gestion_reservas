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

     public function guardar($nombre, $apellidos, $telefono, $email )
    {
        if (!$this->conexion) {
            return false;
        }

        $sql = "INSERT INTO clientes (nombres, apellidos, telefono, email) VALUES (:nombres, :apellidos, :telefono, :email)";
        $consulta = $this->conexion->prepare($sql);
        //bindParams
        $consulta->bindParam(':nombres', $nombre);
        $consulta->bindParam(':apellidos', $apellidos);
        $consulta->bindParam(':telefono', $telefono);
        $consulta->bindParam(':email', $email);

        $consulta->execute();
        $idCliente = $this->conexion->lastInsertId();
        //Regresar el idCliente nuevo
        return (int) $idCliente;
    }

}
