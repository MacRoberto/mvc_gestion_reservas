<?php

include 'config/errors.php';
include 'controllers/LoginController.php';

$accion = isset($_GET['accion']) ? $_GET['accion'] : 'index';

$controlador = new LoginController();
$controlador->procesar($accion);
