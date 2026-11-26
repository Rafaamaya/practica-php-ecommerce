<?php
// TODO: mostrar un cartel de "Etiqueta creada" cuando llega ?status=success en la URL
// (add_etiqueta_acc.php manda status=success para avisar que el INSERT se hizo bien)
$etiquetas = Etiqueta::getTodas();
?>

<section class="py-4">

    <!-- ===== ENCABEZADO (mismo estilo que el inventario de productos) ===== -->
    <header class="inventario__hero rounded-4 p-4 p-lg-5 mb-4">
        <div class="row align-items-center g-4">
            <div class="col-lg-8">
                <p class="inventario__eyebrow text-uppercase mb-2">Panel · Etiquetas</p>
                <h1 class="display-6 fw-bold text-white mb-2">Administración de Etiquetas</h1>
                <p class="text-white-50 mb-0">Las etiquetas <strong class="text-white">destacan los productos</strong> en el catálogo y arman los filtros del menú.</p>
            </div>
            <div class="col-lg-4 text-lg-end">
                <p class="inventario__contador mb-1"><?= count($etiquetas); ?></p>
                <p class="text-white-50 small text-uppercase mb-3"><em>etiquetas creadas</em></p>
                <!-- TODO: crear la vista de alta de etiquetas (hoy este link da 404) -->
                <a href="index.php?content=add_etiqueta" class="btn inventario__btn-agregar rounded-pill px-4">
                    <i class="bi bi-plus-circle-fill" aria-hidden="true"></i> Agregar nueva etiqueta
                </a>
            </div>
        </div>
    </header>

    <!-- ===== LISTADO: cada fila se ve como una tarjeta flotante ===== -->
    <table class="inventario__tabla w-100">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Vista previa</th>
                <th scope="col">Nombre</th>
                <th scope="col">Color</th>
                <th scope="col" class="text-end">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($etiquetas as $etiqueta): ?>
                <tr class="inventario__fila">
                    <td class="inventario__id">#<?= $etiqueta->getId(); ?></td>
                    <!-- Así se ve la etiqueta en las tarjetas del catálogo -->
                    <td>
                        <span class="badge rounded-pill text-bg-<?= $etiqueta->getTipo(); ?> etiqueta-admin__preview"><?= $etiqueta->getNombre(); ?></span>
                    </td>
                    <td class="fw-bold"><?= $etiqueta->getNombre(); ?></td>
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            <div class="etiqueta-admin__muestra bg-<?= $etiqueta->getTipo(); ?>"></div>
                            <code><?= $etiqueta->getTipo(); ?></code>
                        </div>
                    </td>
                    <!-- TODO: el tacho borra al toque, sin preguntar. Sumar una vista de confirmación
                         ("¿Seguro que querés borrar «X»? La tienen N productos") antes de llamar a delete_etiqueta_acc.php -->
                    <td class="text-end text-nowrap">
                        <a href="index.php?content=edit_etiqueta&id=<?= $etiqueta->getId(); ?>"
                            class="inventario__accion inventario__accion--editar" title="Editar"
                            aria-label="Editar <?= $etiqueta->getNombre(); ?>">
                            <i class="bi bi-pencil" aria-hidden="true"></i>
                        </a>
                        <a href="actions/delete_etiqueta_acc.php?id=<?= $etiqueta->getId(); ?>"
                            class="inventario__accion inventario__accion--eliminar" title="Eliminar"
                            aria-label="Eliminar <?= $etiqueta->getNombre(); ?>">
                            <i class="bi bi-trash3" aria-hidden="true"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</section>
