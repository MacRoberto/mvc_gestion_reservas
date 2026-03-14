<?php
include 'views/layouts/header.php';
include 'views/layouts/menu.php';
?>

<div class="contenedor">
    <h1><?php echo $titulo; ?></h1>

    <p><a class="boton" href="hoteles.php?accion=nuevo">Nuevo hotel</a></p>

    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Ciudad</th>
            <th>Acciones</th>
        </tr>
        <?php foreach ($hoteles as $fila) { ?>
            <tr>
                <td><?php echo $fila['id']; ?></td>
                <td><?php echo $fila['nombre']; ?></td>
                <td><?php echo $fila['ciudad']; ?></td>
                <td>
                    <a href="hoteles.php?accion=editar&id=<?php echo $fila['id']; ?>">Editar</a>
                    |
                    <a href="hoteles.php?accion=eliminar&id=<?php echo $fila['id']; ?>" onclick="return confirm('¿Deseas eliminar este hotel?');">Eliminar</a>
                </td>
            </tr>
        <?php } ?>
    </table>
</div>

<?php
include 'views/layouts/footer.php';
?>
