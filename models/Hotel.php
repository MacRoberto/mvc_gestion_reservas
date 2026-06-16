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

    public function obtenerTodos($campo = "todos", $busqueda = "")
    {
        if (!$this->conexion) {
            return array();
        }

        $busquedaLike = '%' . $busqueda . '%';
        $sql = "SELECT id, nombre, ciudad, telefono, email, direccion, descripcion, categoria, hora_checkin, hora_checkout, disponible_general FROM hoteles WHERE deleted_at IS NULL";

        if($busquedaLike != ""){//Solo se aplica el filtro si el usuario ingreso algo en el input
            if ($campo != 'todos') {
                $sql .= " AND ".$campo." LIKE :busqueda";
            } else {
                //Agregar campos adicionales donde se desee aplicar el filtro de busqueda
                $sql .= " AND (nombre LIKE :busqueda OR ciudad LIKE :busqueda OR direccion LIKE :busqueda)";
            }
        }
        

        $sql .= " ORDER BY id DESC";
        $consulta = $this->conexion->prepare($sql);
        $consulta->bindParam(':busqueda', $busquedaLike);
        $consulta->execute();

        return $consulta->fetchAll();
    }

    public function obtenerTodosConImagenPrincipal()
    {
        if (!$this->conexion) {
            return array();
        }

        $sql = "SELECT
                    h.id,
                    h.nombre,
                    h.ciudad,
                    h.telefono,
                    h.email,
                    h.direccion,
                    h.descripcion,
                    h.categoria,
                    h.hora_checkin,
                    h.hora_checkout,
                    h.disponible_general,
                    (
                        SELECT ih.url_imagen
                        FROM imagenes_hotel ih
                        WHERE ih.hotel_id = h.id
                          AND ih.deleted_at IS NULL
                          AND ih.activo = 1
                        ORDER BY ih.principal DESC, ih.id DESC
                        LIMIT 1
                    ) AS imagen_principal
                FROM hoteles h
                WHERE h.deleted_at IS NULL ORDER BY h.id DESC LIMIT 10";

        $consulta = $this->conexion->prepare($sql);
        $consulta->execute();

        return $consulta->fetchAll();
    }

    public function buscarDisponiblesAjax($termino)
    {
        if (!$this->conexion) {
            return array();
        }

        $termino = trim($termino);
        if ($termino === '') {
            return array();
        }

        $sql = "SELECT
                    h.id,
                    h.nombre,
                    h.ciudad,
                    h.direccion,
                    h.disponible_general,
                    (
                        SELECT ih.url_imagen
                        FROM imagenes_hotel ih
                        WHERE ih.hotel_id = h.id
                          AND ih.deleted_at IS NULL
                          AND ih.activo = 1
                        ORDER BY ih.principal DESC, ih.id DESC
                        LIMIT 1
                    ) AS imagen_principal
                FROM hoteles h
                WHERE h.deleted_at IS NULL
                  AND h.disponible_general = 1
                  AND (h.nombre LIKE :termino OR h.ciudad LIKE :termino OR h.direccion LIKE :termino)
                ORDER BY h.nombre ASC
                LIMIT 10";

        $consulta = $this->conexion->prepare($sql);
        $terminoLike = '%' . $termino . '%';
        $consulta->bindParam(':termino', $terminoLike);
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
