<?php

include 'config/errors.php';
include 'controllers/AjaxController.php';

$accion = isset($_GET['accion']) ? $_GET['accion'] : '';

$controlador = new AjaxController();
$controlador->procesar($accion);
