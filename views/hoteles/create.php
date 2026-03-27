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

        <label>direccion</label>
        <input type="text" name="direccion" required>

        <label>Telefono</label>
        <input type="number" name="numero" required>

        <label>Correo electronico</label>
        <input type="email" name="email" required>

        <label>Descriocion</label>
        <input type="text" name="descripcion" required>
        
        <label>categoria</label>
        <input type="text" name="categoria" required>

        <label>Hora check in </label>
        <input type="time" name="hora_checkin" required>

        <label>Check out </label>
        <input type="time" name="hora_checkout" required>

        <label>disponible</label>        
        <select name="disponible" >
        <option value="0">No</option>
        <option value="1">Si</option>
        </select>

        <button type="submit">Guardar</button>
    </form>
</div>

<?php
include 'views/layouts/footer.php';
?>
