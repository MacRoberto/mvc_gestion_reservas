
<?php

include_once 'config/database.php';

class Usuario
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

        $sql = "SELECT id, nombre, telefono, email, contrasena, activo,permiso, user_uuid FROM usuarios WHERE deleted_at IS NULL ORDER BY id DESC";
        $consulta = $this->conexion->prepare($sql);
        $consulta->execute();

        return $consulta->fetchAll();
    }

    public function guardar($nombre, $telefono, $email, $contrasena, $permiso, $activo, $user_uuid)
    {
        if (!$this->conexion) {
            return false;
        }

        $sql = "INSERT INTO usuarios (nombre, telefono, email, contrasena, permiso, activo, user_uuid) VALUES (:nombre, :telefono, :email, :contrasena, :permiso, :activo, :user_uuid)";
        $consulta = $this->conexion->prepare($sql);

        $consulta->bindParam(':nombre', $nombre);
        $consulta->bindParam(':telefono', $telefono);
        $consulta->bindParam(':email', $email);
        $consulta->bindParam(':contrasena', sha1($contrasena));
        $consulta->bindParam(':permiso', $permiso);
        $consulta->bindParam(':activo', $activo);
        $consulta->bindParam(':user_uuid', $user_uuid);

        return $consulta->execute();
    }

    public function obtenerPorId($id)
    {
        if (!$this->conexion) {
            return array('id' => $id, 'nombre' => 'usuario de ejemplo', 'telefono' => 'telefono de ejemplo');
        }

        $sql = "SELECT id, nombre, telefono, email, contrasena, permiso, activo, user_uuid  FROM usuarios WHERE id = :id AND deleted_at IS NULL";
        $consulta = $this->conexion->prepare($sql);
        $consulta->bindParam(':id', $id, PDO::PARAM_INT);
        $consulta->execute();

        return $consulta->fetch();
    }

    public function actualizar($id,$nombre, $telefono, $email, $contrasena, $permiso, $activo, $user_uuid)
    {
        if (!$this->conexion) {
            return false;
        }

        $sql = "UPDATE usuarios SET nombre = :nombre, telefono =:telefono, email = :email, contrasena = :contrasena, permiso = :permiso, activo = :activo, user_uuid = :user_uuid WHERE id = :id AND deleted_at IS NULL";
        $consulta = $this->conexion->prepare($sql);

        $consulta->bindParam(':id', $id, PDO::PARAM_INT);
        $consulta->bindParam(':nombre', $nombre);
        $consulta->bindParam(':telefono', $telefono);
        $consulta->bindParam(':email', $email);
        $consulta->bindParam(':contrasena', sha1($contrasena));
        $consulta->bindParam(':permiso', $permiso);
        $consulta->bindParam(':activo', $activo);
        $consulta->bindParam(':user_uuid', $user_uuid);

        return $consulta->execute();
    }

    public function eliminar($id)
    {
        if (!$this->conexion) {
            return false;
        }

        $fechaEliminacion = date('Y-m-d H:i:s');

        $sql = "UPDATE usuarios SET deleted_at = :deleted_at WHERE id = :id";
        $consulta = $this->conexion->prepare($sql);

        $consulta->bindParam(':deleted_at', $fechaEliminacion);
        $consulta->bindParam(':id', $id, PDO::PARAM_INT);

        return $consulta->execute();
    }
}