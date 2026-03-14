<?php

include 'config/errors.php';
include 'controllers/HabitacionController.php';

$accion = isset($_GET['accion']) ? $_GET['accion'] : 'index';

$controlador = new HabitacionController();
$controlador->procesar($accion);
