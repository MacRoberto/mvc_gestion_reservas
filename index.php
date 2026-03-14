<?php

include 'config/errors.php';
include 'views/layouts/header.php';
include 'views/layouts/menu.php';
?>
<div class="contenedor">
    <h1>Proyecto MVC Escolar</h1>
    <p>Base sencilla para un sistema de reservas de hotel.</p>

    <div class="tarjetas">
        <div class="tarjeta"><a href="hoteles.php">Modulo de hoteles</a></div>
        <div class="tarjeta"><a href="habitaciones.php">Modulo de habitaciones</a></div>
        <div class="tarjeta"><a href="clientes.php">Modulo de clientes</a></div>
        <div class="tarjeta"><a href="reservas.php">Modulo de reservas</a></div>
        <div class="tarjeta"><a href="usuarios.php">Modulo de usuarios</a></div>
        <div class="tarjeta"><a href="login.php">Login</a></div>
    </div>
</div>

<?php
include 'views/layouts/footer.php';
?>
