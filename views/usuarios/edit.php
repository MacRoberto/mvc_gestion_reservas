<?php
include 'views/layouts/header.php';
include 'views/layouts/menu.php';
?>

<div class="contenedor">
    <h1><?php echo $titulo; ?></h1>

    <form action="usuarios.php?accion=actualizar" method="POST">
        <input type="hidden" name="id" value="<?php echo $usuarioEditar['id']; ?>">

        <label>Nombre del usuario</label>
        <input type="text" name="nombre" value="<?php echo $usuarioEditar['nombre']; ?>" required>

        <label>telefono</label>
        <input type="number" name="telefono" value="<?php echo $usuarioEditar['telefono']; ?>" required>

        <label>Email</label>
        <input type="email" name="email" value="<?php echo $usuarioEditar['email']; ?>" required>

        <label>Contraseña</label>
        <input type="password" name="contrasena" value="<?php echo $usuarioEditar['contrasena']; ?>" required>

        <label>Permiso</label>
        <input type="text" name="permiso" value="<?php echo $usuarioEditar['permiso']; ?>" required>

        <label>Activo</label>
        <select name="activo">
            <option value="0" <?php echo $usuarioEditar['activo'] == 0 ? 'selected' : ''; ?>>No</option>
            <option value="1" <?php echo $usuarioEditar['activo'] == 1 ? 'selected' : ''; ?>>Si</option>
        </select>

        <button type="submit">Actualizar</button>
    </form>
</div>

<?php
include 'views/layouts/footer.php';
?>
