<?php

require_once __DIR__ . "/../includes/whitelist.php";
require_once __DIR__ . "/../includes/funciones.php";

$etiqueta = $_GET['etiqueta'] ?? null;
$catalogo_filtrado = null;
$texto_titulo = "";

switch ($etiqueta) {
    case strtolower($etiqueta) == 'oferta':
        $texto_titulo = "Ofertas de loco";
        $catalogo_filtrado = filtrar_etiqueta($etiqueta);
        break;
    case strtolower($etiqueta) == 'nuevo':
        $texto_titulo = "Si estas re manija aca tenes lo nuevo que entro!!!";
        $catalogo_filtrado = filtrar_etiqueta($etiqueta);
        break;
    case strtolower($etiqueta) == 'todo':
        $catalogo_filtrado = get_productos("catalogo");
        $texto_titulo = "Nuestras figuras";
        break;
    default:
        $texto_titulo = "OPSS Algo salio mal";
        break;
}
?>

<div>
    <section id="productos" class="my-5">
        <h2 class="text-center my-4"><?= $texto_titulo; ?></h2>

        <?php if (isset($catalogo_filtrado)): ?>
            <div class="row g-4">
                <p class="text-center text-secondary mb-4 d-none d-lg-block"><em>Pasá el mouse</em> sobre cada figura paraver sus datos.</p>

                <?php foreach ($catalogo_filtrado as $producto): ?>
                    <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                        <div class="border rounded shadow-sm h-100 producto">
                            <img src="img/productos/<?= $producto['imagen']; ?>" class="img-fluid"
                                alt="<?= $producto['alt']; ?>">
                            <div class="producto-info text-center">
                                <h3>
                                    <?= $producto['nombre']; ?>
                                    <?php if (isset($producto['etiqueta'])): ?>
                                        <span class="badge text-bg-<?= $producto['tipo_etiqueta']; ?> align-middle">
                                            <?= $producto['etiqueta']; ?>
                                        </span>
                                    <?php endif; ?>
                                </h3>
                                <p><?= $producto['descripcion']; ?></p>
                                <p><strong class="fs-4"><?= $producto['precio']; ?></strong></p>
                                <a href=<?= $white_list['detalle']['url'] . "&id="  . $producto['id'] ?> class="btn btn-success">Comprar</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>
        <?php endif; ?>

    </section>
</div>