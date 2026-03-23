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

        <label>Direccion</label>
        <input type="text" name="direccion" value="<?php echo $hotelEditar['direccion']; ?>" required>

        <label>Telefono</label>
        <input type="numero" name="telefono" value="<?php echo $hotelEditar['telefono']; ?>" required>

        <label>Correo electronico</label>
        <input type="email" name="email" value="<?php echo $hotelEditar['email']; ?>" required>

        <label>Descripcion</label>
        <input type="text" name="descripcion" value="<?php echo $hotelEditar['descripcion']; ?>" required>

        
        <label>categoria</label>
        <input type="text" name="categoria" value="<?php echo $hotelEditar['categoria']; ?>" required>


        <label>Hora check in </label>
        <input type="time" name="hora_checkin" value="<?php echo $hotelEditar['hora_checkin']; ?>" required>


        <label>Check out </label>
        <input type="time" name="hora_checkout" value="<?php echo $hotelEditar['hora_checkout']; ?>" required>


        <button type="submit">Actualizar</button>
    </form>
</div>

<?php
include 'views/layouts/footer.php';
?>
