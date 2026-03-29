<?php
include 'views/layouts/header.php';
include 'views/layouts/menu.php';
?>

<div class="contenedor">
    <h1><?php echo $titulo; ?></h1>

    <form action="usuarios.php?accion=guardar" method="POST">
        <label>Nombre del usuario</label>
        <input type="text" name="nombre" required>

        <label>Telefono</label>
        <input type="numero" name="numero" required>

        <label>Email</label>
        <input type="email" name="email" required>

        <label>Contraseña</label>
        <input type="password" name="contraseña" required>

        <label>Permiso</label>
        <input type="text" name="permiso" required>

        <label>Activo</label>        
        <select name="Activo" >
        <option value="0">No</option>
        <option value="1">Si</option>
        </select>

        <button type="submit">Guardar</button>
    </form>
</div>

<?php
include 'views/layouts/footer.php';
?>