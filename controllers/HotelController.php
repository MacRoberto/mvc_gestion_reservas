<?php

include_once 'models/Hotel.php';

class HotelController
{
    public function procesar($accion)
    {
        $hotel = new Hotel();

        if ($accion == 'nuevo') {
            $titulo = 'Nuevo hotel';
            include 'views/hoteles/create.php';
        } elseif ($accion == 'guardar') {
            $nombre_p = isset($_POST['nombre']) ? $_POST['nombre'] : '';
            $ciudad = isset($_POST['ciudad']) ? $_POST['ciudad'] : '';
            $dirreccion = isset($_POST['direccion']) ? $_POST['direccion'] : '';
            $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : '';
            $email = isset($_POST['email']) ? $_POST['email'] : '';
            $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : '';
            $categoria = isset($_POST['categoria']) ? $_POST['categoria'] : '';
            $hora_check_in = isset($_POST['hora_checkin']) ? $_POST['hora_checkin'] : '';
            $hora_check_out = isset($_POST['hora_checkout']) ? $_POST['hora_checkout'] : '';
            $disponible = isset($_POST['disponible']) ? $_POST['disponible'] : '';

            $hotel->guardar($nombre_p, $ciudad,$dirreccion, $telefono, $email, $descripcion, $categoria, $hora_checkin, $hora_checkout, $disponible);

            header('Location: hoteles.php');
            exit;
        } elseif ($accion == 'editar') {
            $id = isset($_GET['id']) ? $_GET['id'] : 0;
            $hotelEditar = $hotel->obtenerPorId($id);
            $titulo = 'Editar hotel';
            include 'views/hoteles/edit.php';
        } elseif ($accion == 'actualizar') {
            $id = isset($_POST['id']) ? $_POST['id'] : 0;
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
            $ciudad = isset($_POST['ciudad']) ? $_POST['ciudad'] : '';
            $dirreccion = isset($_POST['direccion']) ? $_POST['direccion'] : '';
            $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : '';
            $email = isset($_POST['email']) ? $_POST['email'] : '';
            $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : '';
            $categoria = isset($_POST['categoria']) ? $_POST['categoria'] : '';
            $hora_check_in = isset($_POST['hora_checkin']) ? $_POST['hora_checkin'] : '';
            $hora_check_out = isset($_POST['hora_checkout']) ? $_POST['hora_checkout'] : '';
            $disponible = isset($_POST['disponible']) ? $_POST['disponible'] : '';

            $hotel->actualizar($id, $nombre, $ciudad, $dirreccion, $telefono, $email, $descripcion, $categoria, $hora_checkin, $hora_checkout, $disponible);
            header('Location: hoteles.php');
            exit;
        } elseif ($accion == 'eliminar') {
            $id = isset($_GET['id']) ? $_GET['id'] : 0;

            $hotel->eliminar($id);
            header('Location: hoteles.php');
            exit;
        } else {
            $hoteles = $hotel->obtenerTodos();//>Consultas
            $titulo = 'Lista de hoteles';
            include 'views/hoteles/index.php';
        }
    }
}
