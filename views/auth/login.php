<?php
include 'views/layouts/header.php';
include 'views/layouts/menu.php';
?>

<div class="contenedor">
    <h1><?php echo $titulo; ?></h1>

    <form action="login.php?accion=login" method="POST">
        <label>Usuario</label>
        <input type="text" name="usuario">

        <label>Contrasena</label>
        <input type="password" name="password">

        <button type="submit">Ingresar</button>
    </form>
</div>

<?php
include 'views/layouts/footer.php';
?>
