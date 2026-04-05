<?php

include_once 'models/Hotel.php';

class HotelController
{
    public function procesar($accion)
    {
        $hotel = new Hotel();
        switch ($accion) {
            case 'nuevo':
                $titulo = 'Nuevo hotel';
                include 'views/hoteles/create.php';
                break;
            case 'guardar':
                $nombre_p = isset($_POST['nombre']) ? $_POST['nombre'] : '';
                $ciudad = isset($_POST['ciudad']) ? $_POST['ciudad'] : '';
                $dirreccion = isset($_POST['direccion']) ? $_POST['direccion'] : '';
                $telefono = isset($_POST['telefono']) ? $_POST[''] : '';
                $email = isset($_POST['email']) ? $_POST['email'] : '';
                $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : '';
                $categoria = isset($_POST['categoria']) ? $_POST['categoria'] : '';
                $hora_checkin = isset($_POST['hora_checkin']) ? $_POST['hora_checkin'] : '';
                $hora_checkout = isset($_POST['hora_checkout']) ? $_POST['hora_checkout'] : '';
                $disponible = isset($_POST['disponible']) ? $_POST['disponible'] : '';

                $hotel->guardar($nombre_p, $ciudad,$dirreccion, $telefono, $email, $descripcion, $categoria, $hora_checkin, $hora_checkout, $disponible);

                header('Location: hoteles.php');
                break;
            case 'editar':
                $id = $_GET['id'] ?? 0;
                $hotelEditar = $hotel->obtenerPorId($id);
                $titulo = 'Editar hotel';
                include 'views/hoteles/edit.php';
                break;
            case 'actualizar':
                $id = $_POST['id'] ?? 0;
                $nombre = $_POST['nombre'] ?? '';
                $ciudad = $_POST['ciudad'] ?? '';
                $dirreccion = $_POST['direccion'] ?? '';
                $telefono = $_POST['telefono'] ?? '';
                $email = $_POST['email'] ?? '';
                $descripcion = $_POST['descripcion'] ?? '';
                $categoria = $_POST['categoria'] ?? '';
                $hora_checkin = $_POST['hora_checkin'] ?? '';
                $hora_checkout = $_POST['hora_checkout'] ?? '';
                $disponible = $_POST['disponible'] ?? '';

                $hotel->actualizar($id, $nombre, $ciudad, $dirreccion, $telefono, $email, $descripcion, $categoria, $hora_checkin, $hora_checkout, $disponible);

                header('Location: hoteles.php');
                break;
            case 'eliminar':
                $id = $_GET['id'] ?? 0;
                $hotel->eliminar($id);

                header('Location: hoteles.php');
                break;
            case 'imagenes':
                $id = $_GET['id'] ?? 0;
                $hotelActual = $hotel->obtenerPorId($id);
                $imagenes = $hotel->obtenerImagenes($id);
                $mensaje = $_GET['mensaje'] ?? '';
                $titulo = 'Imagenes del hotel';

                include 'views/hoteles/imagenes.php';
                break;
            case 'guardar-imagenes':
                $id = isset($_POST['hotel_id']) ? (int) $_POST['hotel_id'] : 0;
                $hotelActual = $hotel->obtenerPorId($id);

                $mensaje = $this->guardarImagenesHotel($hotel, $id);

                header('Location: hoteles.php?accion=imagenes&id=' . $id . '&mensaje=' . urlencode($mensaje));
                break;
            case 'quitar-imagen':
                $imagenId = $_GET['imagen_id'] ?? 0;
                $hotelId = $_GET['id'] ?? 0;

                $hotel->quitarImagen($imagenId);

                header('Location: hoteles.php?accion=imagenes&id=' . $hotelId . '&mensaje=Imagen quitada correctamente');
                break;
            default:
                $campo = isset($_GET['campo']) ? $_GET['campo'] : 'todos';
                $busqueda = isset($_GET['busqueda']) ? trim($_GET['busqueda']) : '';
                $hoteles = $hotel->obtenerTodos($campo, $busqueda);
                
                $titulo = 'Lista de hoteles';
                include 'views/hoteles/index.php';
            break;
        }
    }
    private function guardarImagenesHotel($hotel, $hotelId)
    {
        if (!isset($_FILES['imagenes'])) {
            return 'No se recibieron imagenes.';
        }

        $archivos = $_FILES['imagenes'];
        $permitidas = array('jpg', 'jpeg', 'png');
        $directorioRelativo = 'assets/img/hoteles/' . $hotelId;
        $directorioAbsoluto = __DIR__ . '/../' . $directorioRelativo;

        if (!is_dir($directorioAbsoluto) && !mkdir($directorioAbsoluto, 0777, true)) {
            return 'No se pudo crear la carpeta del hotel.';
        }

        $imagenesActuales = $hotel->obtenerImagenes($hotelId);
        $principalDisponible = count($imagenesActuales) === 0 ? 1 : 0;
        $guardadas = 0;

        for ($i = 0; $i < count($archivos['name']); $i++) {
            if ($archivos['error'][$i] === UPLOAD_ERR_NO_FILE) {
                continue;
            }

            if ($archivos['error'][$i] !== UPLOAD_ERR_OK) {
                continue;
            }

            $nombreOriginal = $archivos['name'][$i];
            $temporal = $archivos['tmp_name'][$i];
            $extension = strtolower(pathinfo($nombreOriginal, PATHINFO_EXTENSION));

            if (!in_array($extension, $permitidas, true)) {
                continue;
            }

            if (@getimagesize($temporal) === false) {
                continue;
            }

            $nombreArchivo = $this->obtenerSiguienteNombreImagen($directorioAbsoluto, $extension);
            $rutaAbsoluta = $directorioAbsoluto . '/' . $nombreArchivo;
            $rutaRelativa = $directorioRelativo . '/' . $nombreArchivo;

            if (!move_uploaded_file($temporal, $rutaAbsoluta)) {
                continue;
            }

            $principal = $principalDisponible === 1 && $guardadas === 0 ? 1 : 0;
            $hotel->guardarImagen($hotelId, $rutaRelativa, $principal, 1);
            $guardadas++;
        }

        if ($guardadas === 0) {
            return 'No se pudo guardar ninguna imagen.';
        }

        return 'Se guardaron ' . $guardadas . ' imagen(es).';
    }

    private function obtenerSiguienteNombreImagen($directorio, $extension)
    {
        $contador = 1;

        while (file_exists($directorio . '/imagen_' . $contador . '.' . $extension)) {
            $contador++;
        }

        return 'imagen_' . $contador . '.' . $extension;
    }
}
