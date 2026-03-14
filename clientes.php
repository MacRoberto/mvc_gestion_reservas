<?php

include 'config/errors.php';
include 'controllers/ClienteController.php';

$accion = isset($_GET['accion']) ? $_GET['accion'] : 'index';

$controlador = new ClienteController();
$controlador->procesar($accion);
