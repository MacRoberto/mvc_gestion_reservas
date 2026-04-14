<?php

include_once 'models/Habitacion.php';
include_once 'models/Hotel.php';

class HabitacionController
{
    public function procesar($accion)
    {
        $habitacion = new Habitacion();

        if ($accion == 'nuevo') {
            $hotel = new Hotel();
            $hoteles = $hotel->obtenerTodos();
            $titulo = 'Nuevo habitacion';
            include 'views/habitaciones/create.php';
        } elseif ($accion == 'guardar') {
             $hotel_id = isset($_POST['hotel_id']) ? $_POST['hotel_id'] : 0;
             $tipo_habitacion = isset($_POST['tipo_habitacion']) ? $_POST['tipo_habitacion'] : '';
             $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : '';
             $capacidad_adultos = isset($_POST['capacidad_adultos']) ? $_POST['capacidad_adultos'] : '';
             $capacidad_ninos = isset($_POST['capacidad_ninos']) ? $_POST['capacidad_ninos'] : '';
             $cantidad_camas = isset($_POST['cantidad_camas']) ? $_POST['cantidad_camas'] : '';
             $precio_noche = isset($_POST['precio_noche']) ? $_POST['precio_noche'] : '';
             $moneda = isset($_POST['moneda']) ? $_POST['moneda'] : '';
             $disponible = isset($_POST['disponible']) ? $_POST['disponible'] : '';
        
            $habitacion->guardar($hotel_id, $tipo_habitacion, $descripcion, $capacidad_adultos, $capacidad_ninos, $cantidad_camas, $precio_noche, $moneda,$disponible);

            header('Location: habitaciones.php');
            exit;
        } elseif ($accion == 'editar') {
            $id = isset($_GET['id']) ? $_GET['id'] : 0;
            $habitacionEditar = $habitacion->obtenerPorId($id);
            $titulo = 'Editar habitaciones';
            include 'views/habitaciones/edit.php';
        } elseif ($accion == 'actualizar') {
           
            $id = isset($_POST['id']) ? $_POST['id'] : 0;
            $tipo_habitacion = isset($_POST['tipo_habitacion']) ? $_POST['tipo_habitacion'] : '';
            $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : '';
            $capacidad_adultos = isset($_POST['capacidad_adultos']) ? $_POST['capacidad_adultos'] : '';
            $capacidad_ninos = isset($_POST['capacidad_ninos']) ? $_POST['capacidad_ninos'] : '';
            $cantidad_camas = isset($_POST['cantidad_camas']) ? $_POST['cantidad_camas'] : '';
            $precio_noche = isset($_POST['precio_noche']) ? $_POST['precio_noche'] : '';
            $moneda = isset($_POST['moneda']) ? $_POST['moneda'] : '';
            $disponible_general = isset($_POST['disponible']) ? $_POST['disponible'] : '';


            $habitacion->actualizar($id, $tipo_habitacion, $descripcion, $capacidad_adultos, $capacidad_ninos, $cantidad_camas, $precio_noche, $moneda, 
            $disponible_general);
            header('Location: habitaciones.php');
            exit;
        } elseif ($accion == 'eliminar') {
            $id = isset($_GET['id']) ? $_GET['id'] : 0;

            $habitacion->eliminar($id);
            header('Location: habitaciones.php');
            exit;
        } elseif ($accion == 'imagenes') {
            $id = $_GET['id'] ?? 0;
            $habitacionActual = $habitacion->obtenerPorId($id);
            $imagenes = $habitacion->obtenerImagenes($id);
            $mensaje = $_GET['mensaje'] ?? '';
            $titulo = 'Imagenes de la habitacion';

            include 'views/habitaciones/imagenes.php';
        } elseif ($accion == 'guardar-imagenes') {
            $id = isset($_POST['habitacion_id']) ? (int) $_POST['habitacion_id'] : 0;
            $habitacionActual = $habitacion->obtenerPorId($id);

            $mensaje = $this->guardarImagenesHabitacion($habitacion, $id);

            header('Location: habitaciones.php?accion=imagenes&id=' . $id . '&mensaje=' . urlencode($mensaje));
        }else if ($accion == 'quitar-imagen') {
            $imagenId = $_GET['imagen_id'] ?? 0;
            $habitacionId = $_GET['id'] ?? 0;

            $habitacion->quitarImagen($imagenId);

            header('Location: habitaciones.php?accion=imagenes&id=' . $habitacionId . '&mensaje=Imagen quitada correctamente');
        }
        
        else {
            $hotelId = isset($_GET['hotel_id']) ? (int) $_GET['hotel_id'] : 0;

            if ($hotelId > 0) {
                $hotel = new Hotel();
                $hotelInfo = $hotel->obtenerPorId($hotelId);
                $habitaciones = $habitacion->obtenerPorHotelId($hotelId);
                $titulo = 'Lista de habitaciones del hotel: ' . $hotelInfo['nombre'];
            } else {
                $hotelId = 0;
                $habitaciones = $habitacion->obtenerTodos();
                $titulo = 'Lista de habitaciones';
            }

            include 'views/habitaciones/index.php';
        }
    }


    private function guardarImagenesHabitacion($habitacion, $habitacionId)
    {
        if (!isset($_FILES['imagenes'])) {
            return 'No se recibieron imagenes.';
        }

        $archivos = $_FILES['imagenes'];
        $permitidas = array('jpg', 'jpeg', 'png');
        $directorioRelativo = 'assets/img/habitaciones/' . $habitacionId;
        $directorioAbsoluto = __DIR__ . '/../' . $directorioRelativo;

        if (!is_dir($directorioAbsoluto) && !mkdir($directorioAbsoluto, 0777, true)) {
            return 'No se pudo crear la carpeta del hotel.';
        }

        $imagenesActuales = $habitacion->obtenerImagenes($habitacionId);
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
            $habitacion->guardarImagen($habitacionId, $rutaRelativa, $principal, 1);
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
