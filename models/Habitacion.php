<?php

include_once 'config/database.php';

class Habitacion
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

        $sql = "SELECT id, hotel_id, tipo_habitacion, descripcion, capacidad_adultos, capacidad_ninos, cantidad_camas, precio_noche, moneda, disponible_general FROM habitaciones WHERE deleted_at IS NULL ORDER BY id DESC";
        $consulta = $this->conexion->prepare($sql);
        $consulta->execute();

        return $consulta->fetchAll();
    }

    public function guardar($hotel_id,$tipo_habitacion, $descripcion, $capacidad_adultos, $capacidad_ninos, $cantidad_camas, $precio_noche, $moneda, $disponible_general)
    {
        if (!$this->conexion) {
            return false;
        }

        $sql = "INSERT INTO habitaciones (hotel_id,tipo_habitacion, descripcion, capacidad_adultos, capacidad_ninos, cantidad_camas, precio_noche, moneda, disponible_general) VALUES ( :hotel_id, :tipo_abitacion, :descripcion, :capacidad_adultos, :capacidad_ninos, :capacidad_camas, :precio_noche, :moneda, :disponible_general)";
        $consulta = $this->conexion->prepare($sql);
        
        $consulta->bindParam(':hotel_id', $hotel_id, PDO::PARAM_INT);
        $consulta->bindParam(':tipo_habitacion', $tipo_habitacion);
        $consulta->bindParam(':descripcion', $descripcion);
        $consulta->bindParam(':capacidad_adultos', $capacidad_adultos);
        $consulta->bindParam(':capacidad_ninos', $capacidad_ninos);
        $consulta->bindParam(':cantidad_cama', $cantidad_camas);
        $consulta->bindParam(':precio_noche', $precio_noche);
        $consulta->bindParam(':moneda', $moneda);
        $consulta->bindParam(':disponible_general', $disponible_general);
       

        return $consulta->execute();
    }

    public function obtenerPorId($id)
    {
        if (!$this->conexion) {
            return array('id' => $id, 'tipo_habitacion' => 'Habitacion de ejemplo', 'descripcion' => 'descripcion de ejemplo');
        }

        $sql = "SELECT id, tipo_habitacion, descripcion, capacidad_adultos, capacidad_ninos, cantidad_camas, precio_noche, moneda, disponible_general  FROM hoteles WHERE id = :id AND deleted_at IS NULL";
        $consulta = $this->conexion->prepare($sql);
        $consulta->bindParam(':id', $id, PDO::PARAM_INT);
        $consulta->execute();

        return $consulta->fetch();
    }

    public function actualizar($id,$tipo_habitacion, $descripcion, $capacidad_adultos, $capacidad_ninos, $cantidad_camas, $precio_noche, $moneda, $disponible_general)
    {
        if (!$this->conexion) {
            return false;
        }

        $sql = "UPDATE hoteles SET tipo_habtacion = :tipo_habitacion, descripcion = :descripcion, capacidad_adultos =:capacidad_adultos, capacidad_ninos = :capacidad_ninos, cantidad_camas = :cantidad_camas, precio_noche = :precio_noche, moneda = :moneda, disponible_general = :disponible_general, WHERE id = :id AND deleted_at IS NULL";
        $consulta = $this->conexion->prepare($sql);

        $consulta->bindParam(':id', $id, PDO::PARAM_INT);
        $consulta->bindParam(':tipo_habitacion', $tipo_habitacion);
        $consulta->bindParam(':descripcion', $descripcion);
        $consulta->bindParam(':capacidad_adultos', $capacidad_adultos);
        $consulta->bindParam(':capacidad_ninos', $capacidad_ninos);
        $consulta->bindParam(':capacidad_cama', $cantidad_camas);
        $consulta->bindParam(':precio_noche', $precio_noche);
        $consulta->bindParam(':moneda', $moneda);
        $consulta->bindParam(':disponible_general', $disponible_general);

        return $consulta->execute();
    }

    public function eliminar($id)
    {
        if (!$this->conexion) {
            return false;
        }

        $fechaEliminacion = date('Y-m-d H:i:s');

        $sql = "UPDATE habitaciones SET deleted_at = :deleted_at WHERE id = :id";
        $consulta = $this->conexion->prepare($sql);

        $consulta->bindParam(':deleted_at', $fechaEliminacion);
        $consulta->bindParam(':id', $id, PDO::PARAM_INT);

        return $consulta->execute();
    }
}
