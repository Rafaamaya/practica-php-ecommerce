<?php
$productos = Producto::getCatalogoCompleto();
?>

<section class="py-4">

    <!-- ===== ENCABEZADO DEL INVENTARIO ===== -->
    <header class="inventario__hero rounded-4 p-4 p-lg-5 mb-4">
        <div class="row align-items-center g-4">
            <div class="col-lg-8">
                <p class="inventario__eyebrow text-uppercase mb-2">Panel · Inventario</p>
                <h1 class="display-6 fw-bold text-white mb-2">Administración de Productos</h1>
                <p class="text-white-50 mb-0">Desde acá <strong class="text-white">cargás, editás y das de baja</strong> las figuras de la vitrina.</p>
            </div>
            <div class="col-lg-4 text-lg-end">
                <p class="inventario__contador mb-1"><?= count($productos); ?></p>
                <p class="text-white-50 small text-uppercase mb-3"><em>figuras en catálogo</em></p>
                <!-- TODO: crear la vista de alta (hoy este link da 404) -->
                <a href="index.php?content=add_producto" class="btn inventario__btn-agregar rounded-pill px-4">
                    <i class="bi bi-plus-circle-fill" aria-hidden="true"></i> Agregar nuevo producto
                </a>
            </div>
        </div>
    </header>

    <!-- ===== LISTADO: cada fila se ve como una tarjeta flotante ===== -->
    <table class="inventario__tabla w-100">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Figura</th>
                <th scope="col">Etiquetas</th>
                <th scope="col">Ficha</th>
                <th scope="col">Precio</th>
                <th scope="col" class="text-end">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($productos as $producto): ?>
                <tr class="inventario__fila">
                    <td class="inventario__id">#<?= $producto->getId(); ?></td>
                    <!-- TODO: igual que en el catálogo, se asume que todo producto tiene al menos una imagen -->
                    <td>
                        <div class="d-flex align-items-center gap-3">
                            <img src="../img/productos/<?= $producto->getImagenList()[0]->getRuta(); ?>"
                                class="inventario__imagen"
                                alt="<?= $producto->getImagenList()[0]->getAlt(); ?>">
                            <div>
                                <p class="fw-bold mb-0"><?= $producto->getNombre(); ?></p>
                                <p class="small text-secondary mb-0"><em><?= $producto->getEdicion(); ?></em></p>
                            </div>
                        </div>
                    </td>
                    <td>
                        <?php foreach ($producto->getEtiquetaList() as $etiqueta): ?>
                            <span class="badge rounded-pill text-bg-<?= $etiqueta->getTipo(); ?>"><?= $etiqueta->getNombre(); ?></span>
                        <?php endforeach; ?>
                    </td>
                    <td class="small">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <span class="inventario__ficha-icono"><i class="bi bi-arrows-vertical" aria-hidden="true"></i></span>
                            <div>
                                <p class="inventario__ficha-label mb-0">Altura</p>
                                <p class="mb-0"><strong><?= $producto->getAlturaCm(); ?> cm</strong></p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <span class="inventario__ficha-icono"><i class="bi bi-brush-fill" aria-hidden="true"></i></span>
                            <div>
                                <p class="inventario__ficha-label mb-0">Acabado</p>
                                <p class="text-secondary mb-0"><em><?= $producto->getAcabado(); ?></em></p>
                            </div>
                        </div>
                    </td>
                    <td><span class="inventario__precio">$<?= $producto->getPrecio(); ?></span></td>
                    <!-- TODO: crear las vistas de editar y eliminar (hoy estos links dan 404) -->
                    <td class="text-end text-nowrap">
                        <a href="index.php?content=editar_producto&id=<?= $producto->getId(); ?>"
                            class="inventario__accion inventario__accion--editar" title="Editar"
                            aria-label="Editar <?= $producto->getNombre(); ?>">
                            <i class="bi bi-pencil" aria-hidden="true"></i>
                        </a>
                        <a href="index.php?content=eliminar_producto&id=<?= $producto->getId(); ?>"
                            class="inventario__accion inventario__accion--eliminar" title="Eliminar"
                            aria-label="Eliminar <?= $producto->getNombre(); ?>">
                            <i class="bi bi-trash3" aria-hidden="true"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</section>
