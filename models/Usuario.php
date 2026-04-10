
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

    public function obtenerTodos($campo = "todos", $busqueda = "")
    {
        if (!$this->conexion) {
            return array();
        }

        $busquedaLike = '%' . $busqueda . '%';
        $sql = "SELECT id, nombre, telefono, email, contrasena, activo,permiso, user_uuid 
                FROM usuarios WHERE deleted_at IS NULL";

        if($busquedaLike != ""){//Solo se aplica el filtro si el usuario ingreso algo en el input
            if ($campo != 'todos') {
                $sql .= " AND ".$campo." LIKE :busqueda";
            } else {
                //Agregar campos adicionales donde se desee aplicar el filtro de busqueda
                $sql .= " AND (nombre LIKE :busqueda OR email LIKE :busqueda OR telefono LIKE :busqueda)";
            }
        }
        
        $sql .= " ORDER BY id DESC";
        $consulta = $this->conexion->prepare($sql);
        $consulta->bindParam(':busqueda', $busquedaLike);
        $consulta->execute();

        return $consulta->fetchAll();
    }
//Cierra la sesion de live share
    public function guardar($nombre, $telefono, $email, $contrasena, $permiso, $estatus)
    {
        if (!$this->conexion) {
            return false;
        }

        $sql = "INSERT INTO usuarios (nombre, telefono, email, contrasena, permiso, activo, user_uuid) 
        VALUES (:nombre, :telefono, :email, :contrasena, :permiso, :activo, UUID())";
        $consulta = $this->conexion->prepare($sql);

        $consulta->bindParam(':nombre', $nombre);
        $consulta->bindParam(':telefono', $telefono);
        $consulta->bindParam(':email', $email);
        $consulta->bindParam(':contrasena', md5($contrasena));
        $consulta->bindParam(':permiso', $permiso);
        $consulta->bindParam(':activo', $estatus);

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

    public function actualizar($id,$nombre, $telefono, $email, $permiso, $activo, $contrasena_nueva, $cambiar_pwd)
    {
        if (!$this->conexion) {
            return false;
        }

        $sql_cambiar_contrasena = "";
        if ($cambiar_pwd == 1) {
            $sql_cambiar_contrasena = ", contrasena = :contrasena";
        }
        $sql = "UPDATE 
                    usuarios 
                SET nombre = :nombre, telefono =:telefono, email = :email ".$sql_cambiar_contrasena." , permiso = :permiso, activo = :activo WHERE id = :id AND deleted_at IS NULL";
        
        $consulta = $this->conexion->prepare($sql);

        $consulta->bindParam(':id', $id, PDO::PARAM_INT);
        $consulta->bindParam(':nombre', $nombre);
        $consulta->bindParam(':telefono', $telefono);
        $consulta->bindParam(':email', $email);
        if ($cambiar_pwd == 1) {
            $consulta->bindParam(':contrasena', md5($contrasena_nueva));
        }
        $consulta->bindParam(':permiso', $permiso);
        $consulta->bindParam(':activo', $activo);

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

    public function validarContrasena($id = 0, $email, $contrasena)
    {
        if (!$this->conexion) {
            return false;
        }

        $sql = "SELECT id FROM usuarios WHERE (id = :id OR email = :email) AND contrasena = :contrasena AND deleted_at IS NULL";
        $pwdEncriptado = md5($contrasena);
        $consulta = $this->conexion->prepare($sql);
        $consulta->bindParam(':id', $id, PDO::PARAM_INT);
        $consulta->bindParam(':email', $email);
        $consulta->bindParam(':contrasena', $pwdEncriptado);
        $consulta->execute();

        return $consulta->fetch() !== false;
    }
}