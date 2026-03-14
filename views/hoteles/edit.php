<?php
include 'views/layouts/header.php';
include 'views/layouts/menu.php';
?>

<div class="contenedor">
    <h1><?php echo $titulo; ?></h1>

    <form action="hoteles.php?accion=actualizar" method="POST">
        <input type="hidden" name="id" value="<?php echo $hotelEditar['id']; ?>">

        <label>Nombre del hotel</label>
        <input type="text" name="nombre" value="<?php echo $hotelEditar['nombre']; ?>" required>

        <label>Ciudad</label>
        <input type="text" name="ciudad" value="<?php echo $hotelEditar['ciudad']; ?>" required>

        <button type="submit">Actualizar</button>
    </form>
</div>

<?php
include 'views/layouts/footer.php';
?>
