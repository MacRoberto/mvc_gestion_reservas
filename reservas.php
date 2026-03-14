<?php

include 'config/errors.php';
include 'controllers/ReservaController.php';

$accion = isset($_GET['accion']) ? $_GET['accion'] : 'index';

$controlador = new ReservaController();
$controlador->procesar($accion);
