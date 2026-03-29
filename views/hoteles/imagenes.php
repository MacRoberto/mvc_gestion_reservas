<?php
include 'views/layouts/header.php';
include 'views/layouts/menu.php';
?>

<div class="contenedor">
    <h1 style="text-align: center;"><?php echo $hotelActual['nombre']; ?></h1>

    <?php if (!empty($mensaje)) { ?>
        <p><?php echo $mensaje; ?></p>
    <?php } ?>

    <div style="display: flex; gap: 24px; align-items: flex-start; flex-wrap: wrap;">
        <div style="flex: 1; min-width: 320px;">
            <h2>Subir imagenes</h2>

            <form action="hoteles.php?accion=guardar-imagenes" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="hotel_id" value="<?php echo $hotelActual['id']; ?>">
                <input type="file" name="imagenes[]" accept=".png,.jpg,.jpeg" multiple required>

                <button type="submit">Subir imagenes</button>
            </form>
        </div>

        <div style="flex: 1; min-width: 320px;">
            <h2>Imagenes actuales</h2>

            <?php if (empty($imagenes)) { ?>
                <p>Este hotel todavia no tiene imagenes registradas.</p>
            <?php } else { ?>
                <div class="galeria-imagenes">
                    <?php foreach ($imagenes as $imagen) { ?>
                        <div class="tarjeta-imagen">
                            <img src="<?php echo $imagen['url_imagen']; ?>" alt="Imagen del hotel" style="max-width: 220px; height: auto;">
                            <p><?php echo basename($imagen['url_imagen']); ?></p>
                            <p>Principal: <?php echo $imagen['principal'] == 1 ? 'Si' : 'No'; ?></p>
                            <p>
                                <a href="hoteles.php?accion=quitar-imagen&id=<?php echo $hotelActual['id']; ?>&imagen_id=<?php echo $imagen['id']; ?>" onclick="return confirm('¿Deseas quitar esta imagen?');">
                                    Quitar imagen
                                </a>
                            </p>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<?php
include 'views/layouts/footer.php';
?>
