<?php
include 'views/layouts/header.php';
include 'views/layouts/menu.php';
?>

<div class="contenedor">
    <h1><?php echo $titulo; ?></h1>

    <form action="hoteles.php?accion=guardar" method="POST">
        <label>Nombre del hotel</label>
        <input type="text" name="nombre" required>

        <label>Ciudad</label>
        <input type="text" name="ciudad" required>

        <button type="submit">Guardar</button>
    </form>
</div>

<?php
include 'views/layouts/footer.php';
?>
