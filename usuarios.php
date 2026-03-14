<?php

include 'config/errors.php';
include 'controllers/UsuarioController.php';

$accion = isset($_GET['accion']) ? $_GET['accion'] : 'index';

$controlador = new UsuarioController();
$controlador->procesar($accion);
