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

        $sql = "SELECT id, nombre, ciudad, telefono, email, direccion, descripcion, categoria, hora_checkin, hora_checkout, disponible_general FROM hoteles WHERE deleted_at IS NULL ORDER BY id DESC";
        $consulta = $this->conexion->prepare($sql);
        $consulta->execute();

        return $consulta->fetchAll();
    }

    public function guardar($nombre, $ciudad,$dirreccion, $telefono, $email, $descripcion, $categoria, $hora_checkin, $hora_check_out, $disponible)
    {
        if (!$this->conexion) {
            return false;
        }

        $sql = "INSERT INTO hoteles (nombre, ciudad, telefono, direccion, email, descripcion, categoria, hora_checkin, hora_checkout, disponible_general) VALUES (:nombre, :ciudad, :telefono, :direccion, :email, :descripcion, :categoria, :hora_checkin, :hora_checkout, :disponible_general)";
        $consulta = $this->conexion->prepare($sql);

        $consulta->bindParam(':nombre', $nombre);
        $consulta->bindParam(':ciudad', $ciudad);
        $consulta->bindParam(':telefono', $telefono);
        $consulta->bindParam(':direccion', $dirreccion);
        $consulta->bindParam(':email', $email);
        $consulta->bindParam(':descripcion', $descripcion);
        $consulta->bindParam(':categoria', $categoria);
        $consulta->bindParam(':hora_checkin', $hora_check_in);
        $consulta->bindParam(':hora_checkout', $hora_check_out);
        $consulta->bindParam(':disponible_general', $disponible);
       

        return $consulta->execute();
    }

    public function obtenerPorId($id)
    {
        if (!$this->conexion) {
            return array('id' => $id, 'nombre' => 'Hotel de ejemplo', 'ciudad' => 'Ciudad de ejemplo');
        }

        $sql = "SELECT id, nombre, ciudad, telefono, direccion, email, descripcion, categoria, hora_checkin, hora_checkout, disponible_general  FROM hoteles WHERE id = :id AND deleted_at IS NULL";
        $consulta = $this->conexion->prepare($sql);
        $consulta->bindParam(':id', $id, PDO::PARAM_INT);
        $consulta->execute();

        return $consulta->fetch();
    }

    public function actualizar($id, $nombre, $ciudad, $dirreccion, $telefono, $email, $descripcion, $categoria, $hora_checkin, $hora_check_out, $disponible)
    {
        if (!$this->conexion) {
            return false;
        }

        $sql = "UPDATE hoteles SET nombre = :nombre, ciudad = :ciudad, telefono =:telefono, direccion = :direccion, email = :email, descripcion = :descripcion,categoria = :categoria, hora_checkin = :hora_checkin, hora_checkout = :hora_checkout, disponible_general = :disponible_general WHERE id = :id AND deleted_at IS NULL";
        $consulta = $this->conexion->prepare($sql);

        $consulta->bindParam(':id', $id, PDO::PARAM_INT);
        $consulta->bindParam(':nombre', $nombre);
        $consulta->bindParam(':ciudad', $ciudad);
        $consulta->bindParam(':telefono', $telefono);
        $consulta->bindParam(':direccion', $dirreccion);
        $consulta->bindParam(':email', $email);
        $consulta->bindParam(':descripcion', $descripcion);
        $consulta->bindParam(':categoria', $categoria);
        $consulta->bindParam(':hora_checkin', $hora_check_in);
        $consulta->bindParam(':hora_checkout', $hora_check_out);
        $consulta->bindParam(':disponible_general', $disponible);

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
