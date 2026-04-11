<?php
@session_start();
if (!isset($_SESSION['nombre'])) {
    header("Location: login.php");
    exit();
}

include 'config/errors.php';
include 'controllers/ReservaController.php';

$accion = isset($_GET['accion']) ? $_GET['accion'] : 'index';

$controlador = new ReservaController();
$controlador->procesar($accion);
