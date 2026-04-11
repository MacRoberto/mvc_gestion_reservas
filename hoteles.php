<?php 
//Agregar validación de sesión para evitar que usuarios no autenticados accedan a esta página
@session_start();
if (!isset($_SESSION['nombre'])) {
    header("Location: login.php");
    exit();
}

include 'config/errors.php';
include 'controllers/HotelController.php';

$accion = isset($_GET['accion']) ? $_GET['accion'] : 'index';

$controlador = new HotelController();
$controlador->procesar($accion);

