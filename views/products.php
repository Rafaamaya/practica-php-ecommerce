<?php

require_once __DIR__ . "/../includes/whitelist.php";
require_once __DIR__ . "/../includes/funciones.php";
require_once __DIR__ . "/../classes/Producto.php";





/*     echo "<pre>";
    print_r($productos);
    echo "</pre>"; */


$titulos = [
    'Oferta' => 'Ofertas de loco',
    'Nuevo'  => 'Si estás re manija, acá tenés lo nuevo que entró',
    'Últimas unidades' => 'Si te dormiste, estas son las últimas unidades que quedan',
];

$etiquetaId = (int) ($_GET['etiqueta'] ?? 0);
$etiquetaActual = Etiqueta::getPorId($etiquetaId);


if ($etiquetaActual) {
    $nombre = $etiquetaActual->getNombre();
    $texto_titulo = $titulos[$nombre] ?? $nombre;
    $catalogo_filtrado = Producto::getPorEtiqueta($etiquetaId);
} else {
    $texto_titulo = "Nuestras figuras";
    $catalogo_filtrado = Producto::getCatalogoCompleto();
}
?>

<div>
    <section id="productos" class="my-5">
        <h2 class="text-center my-4"><?= $texto_titulo; ?></h2>

        <?php if (isset($catalogo_filtrado)): ?>
            <div class="row g-4">
                <p class="text-center text-secondary mb-4 d-none d-lg-block"><em>Pasá el mouse</em> sobre cada figura para ver sus datos.</p>

                <?php foreach ($catalogo_filtrado as $producto): ?>
                    <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                        <div class="border rounded shadow-sm h-100 producto">
                            <img src="img/productos/<?= $producto->getImagen(); ?>" class="img-fluid"
                                alt="<?= $producto->getAlt(); ?>">
                            <div class="producto-info text-center">
                                <h3>
                                    <?= $producto->getNombre(); ?>
                                    <?php foreach ($producto->getEtiquetaList() as $etiqueta): ?>
                                        <span class="badge text-bg-<?= $etiqueta->getTipo(); ?> align-middle">
                                            <?= $etiqueta->getNombre(); ?>
                                        </span>
                                    <?php endforeach; ?>
                                </h3>
                                <p><?= $producto->getDescripcion(); ?></p>
                                <p><strong class="fs-4"><?= $producto->getPrecio(); ?></strong></p>
                                <a href="<?= $white_list['detalle']['url'] . "&id="  . $producto->getId() ?>" class="btn btn-success">Detalles</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>
        <?php endif; ?>

    </section>
</div>