<?php

include_once 'config/database.php';

class Hotel
{
    private $conexion;

    public function __construct()
    {
        $database = new Database();
        $this->conexion = $database->conectar();
    }

    public function obtenerTodos()
    {
        if (!$this->conexion) {
            return array();
        }

        $sql = "SELECT id, nombre, ciudad, telefono FROM hoteles WHERE deleted_at IS NULL ORDER BY id DESC";
        $consulta = $this->conexion->prepare($sql);
        $consulta->execute();

        return $consulta->fetchAll();
    }

    public function guardar($nombre, $ciudad)
    {
        if (!$this->conexion) {
            return false;
        }

        $sql = "INSERT INTO hoteles (nombre, ciudad, telefono) VALUES (:nombre, :ciudad, :telefono)";
        $consulta = $this->conexion->prepare($sql);

        $consulta->bindParam(':nombre', $nombre);
        $consulta->bindParam(':ciudad', $ciudad);
        $consulta->bindParam(':telefono', $telefono);

        return $consulta->execute();
    }

    public function obtenerPorId($id)
    {
        if (!$this->conexion) {
            return array('id' => $id, 'nombre' => 'Hotel de ejemplo', 'ciudad' => 'Ciudad de ejemplo');
        }

        $sql = "SELECT id, nombre, ciudad FROM hoteles WHERE id = :id AND deleted_at IS NULL";
        $consulta = $this->conexion->prepare($sql);
        $consulta->bindParam(':id', $id, PDO::PARAM_INT);
        $consulta->execute();

        return $consulta->fetch();
    }

    public function actualizar($id, $nombre, $ciudad)
    {
        if (!$this->conexion) {
            return false;
        }

        $sql = "UPDATE hoteles SET nombre = :nombre, ciudad = :ciudad WHERE id = :id";
        $consulta = $this->conexion->prepare($sql);

        $consulta->bindParam(':id', $id, PDO::PARAM_INT);
        $consulta->bindParam(':nombre', $nombre);
        $consulta->bindParam(':ciudad', $ciudad);

        return $consulta->execute();
    }

    public function eliminar($id)
    {
        if (!$this->conexion) {
            return false;
        }

        $fechaEliminacion = date('Y-m-d H:i:s');

        $sql = "UPDATE hoteles SET deleted_at = :deleted_at WHERE id = :id";
        $consulta = $this->conexion->prepare($sql);

        $consulta->bindParam(':deleted_at', $fechaEliminacion);
        $consulta->bindParam(':id', $id, PDO::PARAM_INT);

        return $consulta->execute();
    }
}
