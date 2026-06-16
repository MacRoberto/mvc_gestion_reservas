<div class="menu">
    <a href="index.php">Inicio</a>
     <?php
        //admin
        if (isset($_SESSION['permiso']) && $_SESSION['permiso'] == 'admin') {
            echo '
                <a href="hoteles.php">Hoteles</a>
                <a href="habitaciones.php">Habitaciones</a>
                <a href="reservas.php">Reservas</a>'; 
        }
        //propietario
        if (isset($_SESSION['permiso']) && $_SESSION['permiso'] == 'propietario') {
            echo '
                <a href="hoteles.php">Hoteles</a>
                <a href="habitaciones.php">Habitaciones</a>';
        }
        //IT
        if (isset($_SESSION['permiso']) && $_SESSION['permiso'] == 'IT') {
            echo '
                <a href="hoteles.php">Hoteles</a>
                <a href="habitaciones.php">Habitaciones</a>
                <a href="usuarios.php">Usuarios</a>
                <a href="reservas.php">Reservas</a>';
        }
        //usuario
        if (isset($_SESSION['permiso']) && $_SESSION['permiso'] == 'usuario') {
            echo '
                <a href="habitaciones.php">Habitaciones</a>
                <a href="reservas.php">Reservas</a>';
        }
    ?>
    <a href='login.php'>Cerrar sesión</a>
    <a href='motor_busqueda.php' target = "_blank">Motor de búsqueda</a>
</div>
