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

    public function guardar($nombre, $ciudad,$dirreccion, $telefono, $email, $descripcion, $categoria, $hora_checkin, $hora_checkout, $disponible)
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
        $consulta->bindParam(':hora_checkin', $hora_checkin);
        $consulta->bindParam(':hora_checkout', $hora_checkout);
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

    public function actualizar($id, $nombre, $ciudad, $dirreccion, $telefono, $email, $descripcion, $categoria, $hora_checkin, $hora_checkout, $disponible)
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
        $consulta->bindParam(':hora_checkin', $hora_checkin);
        $consulta->bindParam(':hora_checkout', $hora_checkout);
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

    public function obtenerImagenes($hotelId)
    {
        if (!$this->conexion) {
            return array();
        }

        $sql = "SELECT id, hotel_id, url_imagen, principal, activo, created_at, updated_at
                FROM imagenes_hotel
                WHERE hotel_id = :hotel_id AND deleted_at IS NULL
                ORDER BY principal DESC, id DESC";
        $consulta = $this->conexion->prepare($sql);
        $consulta->bindParam(':hotel_id', $hotelId, PDO::PARAM_INT);
        $consulta->execute();

        return $consulta->fetchAll();
    }

    public function guardarImagen($hotelId, $urlImagen, $principal = 0, $activo = 1)
    {
        if (!$this->conexion) {
            return false;
        }

        $sql = "INSERT INTO imagenes_hotel (hotel_id, url_imagen, principal, activo, created_at, updated_at)
                VALUES (:hotel_id, :url_imagen, :principal, :activo, NOW(), NOW())";
        $consulta = $this->conexion->prepare($sql);

        $consulta->bindParam(':hotel_id', $hotelId, PDO::PARAM_INT);
        $consulta->bindParam(':url_imagen', $urlImagen);
        $consulta->bindParam(':principal', $principal, PDO::PARAM_INT);
        $consulta->bindParam(':activo', $activo, PDO::PARAM_INT);

        return $consulta->execute();
    }

    public function quitarImagen($imagenId)
    {
        if (!$this->conexion) {
            return false;
        }

        $fechaEliminacion = date('Y-m-d H:i:s');

        $sql = "UPDATE imagenes_hotel
                SET deleted_at = :deleted_at
                WHERE id = :id";

        $consulta = $this->conexion->prepare($sql);
        $consulta->bindParam(':deleted_at', $fechaEliminacion);
        $consulta->bindParam(':id', $imagenId, PDO::PARAM_INT);

        return $consulta->execute();
    }
}
