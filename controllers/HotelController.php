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
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
            $ciudad = isset($_POST['ciudad']) ? $_POST['ciudad'] : '';

            $hotel->guardar($nombre, $ciudad);
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

            $hotel->actualizar($id, $nombre, $ciudad);
            header('Location: hoteles.php');
            exit;
        } elseif ($accion == 'eliminar') {
            $id = isset($_GET['id']) ? $_GET['id'] : 0;

            $hotel->eliminar($id);
            header('Location: hoteles.php');
            exit;
        } else {
            $hoteles = $hotel->obtenerTodos();
            $titulo = 'Lista de hoteles';
            include 'views/hoteles/index.php';
        }
    }
}
