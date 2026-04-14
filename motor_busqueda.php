<?php

include 'config/errors.php';
include 'controllers/MotorController.php';

$accion = isset($_GET['accion']) ? $_GET['accion'] : 'index';

$controlador = new MotorController();
$controlador->procesar($accion);
