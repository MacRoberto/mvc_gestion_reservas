<?php

include 'config/errors.php';
include 'controllers/HotelController.php';

$accion = isset($_GET['accion']) ? $_GET['accion'] : 'index';

$controlador = new HotelController();
$controlador->procesar($accion);
