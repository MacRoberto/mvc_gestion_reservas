<?php

include_once 'models/habitacion.php';

class HabitacionController
{
    public function procesar($accion)
    {
        $habitacion = new Habitacion();

        if ($accion == 'nuevo') {
            $titulo = 'Nuevo habitacion';
            include 'views/habitaciones/create.php';
        } elseif ($accion == 'guardar') {
            $tipo_habitacion = isset($_POST['tipo_habitacion']) ? $_POST['tipo_habitacion'] : '';
             $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : '';
             $capacidad_adultos = isset($_POST['capacidad_adultos']) ? $_POST['capacidad_adultos'] : '';
             $capacidad_ninos = isset($_POST['capacidad_ninos']) ? $_POST['capacidad_ninos'] : '';
             $cantidad_camas = isset($_POST['cantidad_camas']) ? $_POST['cantidad_camas'] : '';
             $precio_noche = isset($_POST['precio_noche']) ? $_POST['precio_noche'] : '';
             $moneda = isset($_POST['moneda']) ? $_POST['moneda'] : '';
             $disponible = isset($_POST['disponible']) ? $_POST['disponible'] : '';
        

            $habitacion->guardar($tipo_habitacion, $descripcion, $capacidad_adultos, $capacidad_ninos, $cantidad_camas, $precio_noche, $moneda,$disponible);

            header('Location: hoteles.php');
            exit;
        } elseif ($accion == 'editar') {
            $id = isset($_GET['id']) ? $_GET['id'] : 0;
            $habitacionEditar = $habitaciones->obtenerPorId($id);
            $titulo = 'Editar habitaciones';
            include 'views/habitaciones/edit.php';
        } elseif ($accion == 'actualizar') {
            $id = isset($_POST['id']) ? $_POST['id'] : 0;
            $tipo_habitacion = isset($_POST['tipo_habitacion']) ? $_POST['tipo_habitacion'] : '';
            $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : '';
            $capacidad_adultos = isset($_POST['capacidad_adultos']) ? $_POST['capacidad_adultos'] : '';
            $capacidad_ninos = isset($_POST['capacidad_ninos']) ? $_POST['capacidad_ninos'] : '';
            $capacidad_camas = isset($_POST['capacidad_camas']) ? $_POST['capacidad_camas'] : '';
            $precio_noche = isset($_POST['descripcion']) ? $_POST['descripcion'] : '';
            $moneda = isset($_POST['categoria']) ? $_POST['categoria'] : '';
            $disponible_general = isset($_POST['hora_check_in']) ? $_POST['hora_check_in'] : '';

            $habitacionesl->actualizar($id, $tipo_habitacion, $descripcion, $capacidad_adultos, $capacidad_ninos, $capacidad_camas, $precio_noche, $moneda,$disponible_general);
            header('Location: habitaciones.php');
            exit;
        } elseif ($accion == 'eliminar') {
            $id = isset($_GET['id']) ? $_GET['id'] : 0;

            $habitacion->eliminar($id);
            header('Location: habitaciones.php');
            exit;
        } else {
            $habitaciones = $habitacion->obtenerTodos();//>Consultas
            $titulo = 'Lista de habitaciones';
            include 'views/habitaciones/index.php';
        }
    }
}