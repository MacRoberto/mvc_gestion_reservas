<?php
@session_start();
if (!isset($_SESSION['nombre'])) {
    header("Location: login.php");
    exit();
}
include 'config/errors.php';
include 'views/layouts/header.php';
include 'views/layouts/menu.php';
?>
<div class="contenedor">
    <h1>Administración Experiencias May</h1>

    <div class="tarjetas">
        <?php
        //admin
        if (isset($_SESSION['permiso']) && $_SESSION['permiso'] == 'admin') {
            echo '
                <div class="tarjeta"><a href="hoteles.php">Modulo de hoteles</a></div>
                <div class="tarjeta"><a href="habitaciones.php">Modulo de habitaciones</a></div>
                <div class="tarjeta"><a href="reservas.php">Modulo de reservas</a></div>
                '; 
        }
        //propietario
        if (isset($_SESSION['permiso']) && $_SESSION['permiso'] == 'propietario') {
            echo '
                <div class="tarjeta"><a href="hoteles.php">Modulo de hoteles</a></div>
                <div class="tarjeta"><a href="habitaciones.php">Modulo de habitaciones</a></div>
                ';
        }
        //IT
        if (isset($_SESSION['permiso']) && $_SESSION['permiso'] == 'IT') {
            echo '
                <div class="tarjeta"><a href="hoteles.php">Modulo de hoteles</a></div>
                <div class="tarjeta"><a href="habitaciones.php">Modulo de habitaciones</a></div>
                <div class="tarjeta"><a href="clientes.php">Modulo de clientes</a></div>
                <div class="tarjeta"><a href="reservas.php">Modulo de reservas</a></div>
                <div class="tarjeta"><a href="usuarios.php">Modulo de usuarios</a></div>
            ';
        }
        //usuario
        if (isset($_SESSION['permiso']) && $_SESSION['permiso'] == 'usuario') {
            echo '
                <div class="tarjeta"><a href="habitaciones.php">Modulo de habitaciones</a></div>
                <div class="tarjeta"><a href="reservas.php">Modulo de reservas</a></div>
                ';
        }
    ?>
        
    </div>
</div>

<?php
include 'views/layouts/footer.php';
?>
