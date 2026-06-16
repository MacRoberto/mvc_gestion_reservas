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

// Sí, accion es igual a nuevo o editar o eliminar y el permiso es usuario no tiene acceso y va al index 
if (($accion == "nuevo" || $accion == "editar" || $accion == "eliminar") && $_SESSION['permiso'] == 'usuario') {
    $accion = "index";
}

$controlador->procesar($accion);

