<?php
$id = (int) ($_GET['id'] ?? 0);
$etiqueta = Etiqueta::getPorId($id);

// TODO: este array está repetido en add_etiqueta.php; si se agrega un color hay que sumarlo en los dos
$colores = [
    'success'   => 'Verde',
    'danger'    => 'Rojo',
    'warning'   => 'Amarillo',
    'info'      => 'Celeste',
    'primary'   => 'Azul',
    'secondary' => 'Gris',
    'dark'      => 'Negro'
];
?>

<section class="py-4">

    <?php if ($etiqueta): ?>

        <!-- ===== ENCABEZADO ===== -->
        <header class="inventario__hero rounded-4 p-4 mb-4">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                <div>
                    <p class="inventario__eyebrow text-uppercase mb-2">Panel · Editar etiqueta #<?= $etiqueta->getId(); ?></p>
                    <h1 class="h2 fw-bold text-white mb-1">Editar «<?= $etiqueta->getNombre(); ?>»</h1>
                    <p class="text-white-50 mb-0">Cambiá el nombre o el color. <strong class="text-white">Todos los productos</strong> con esta etiqueta se actualizan solos.</p>
                </div>
                <a href="index.php?content=admin_etiquetas" class="btn btn-outline-light rounded-pill px-4">
                    <i class="bi bi-arrow-left" aria-hidden="true"></i> Volver a etiquetas
                </a>
            </div>
        </header>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <form action="actions/edit_etiqueta_acc.php" method="post" class="card border-0 shadow-sm rounded-4 p-4 p-lg-5">

                    <!-- El id viaja oculto: el usuario no lo ve, pero el action lo necesita para saber qué fila actualizar -->
                    <input type="hidden" name="id" value="<?= $etiqueta->getId(); ?>">

                    <!-- ===== 1. NOMBRE ===== -->
                    <fieldset class="mb-4">
                        <legend class="formulario__leyenda"><span class="inventario__ficha-icono"><i class="bi bi-fonts" aria-hidden="true"></i></span> Nombre</legend>
                        <label
                            for="nombre"
                            class="form-label">
                            Nombre de la etiqueta *
                        </label>
                        <input
                            type="text"
                            class="form-control"
                            id="nombre"
                            name="nombre"
                            maxlength="30"
                            value="<?= $etiqueta->getNombre(); ?>"
                            required>
                        <p class="form-text mb-0">Hasta <strong>30 caracteres</strong>. No puede repetirse con otra etiqueta.</p>
                    </fieldset>

                    <!-- ===== 2. COLOR ===== -->
                    <fieldset class="mb-4">
                        <legend class="formulario__leyenda"><span class="inventario__ficha-icono"><i class="bi bi-palette-fill" aria-hidden="true"></i></span> Color *</legend>
                        <p class="small text-secondary">Hoy usa <span class="badge rounded-pill text-bg-<?= $etiqueta->getTipo(); ?>"><?= $etiqueta->getNombre(); ?></span>. Elegí otro <em>si querés cambiarlo</em>.</p>

                        <div class="row g-2">
                            <?php foreach ($colores as $tipo => $nombreColor): ?>
                                <div class="col-6 col-md-4">
                                    <input
                                        type="radio"
                                        class="btn-check"
                                        name="tipo"
                                        id="tipo_<?= $tipo; ?>"
                                        value="<?= $tipo; ?>"
                                        <?php if ($tipo == $etiqueta->getTipo()): ?>checked<?php endif; ?>
                                        required>
                                    <label
                                        class="color-opcion w-100"
                                        for="tipo_<?= $tipo; ?>">
                                        <span class="etiqueta-admin__muestra bg-<?= $tipo; ?>"></span>
                                        <span class="d-block fw-bold"><?= $nombreColor; ?></span>
                                        <span class="badge rounded-pill text-bg-<?= $tipo; ?>">Ejemplo</span>
                                    </label>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </fieldset>

                    <!-- ===== BOTONES ===== -->
                    <div class="d-flex flex-column flex-sm-row justify-content-end gap-2 border-top pt-4">
                        <a href="index.php?content=admin_etiquetas" class="btn btn-light rounded-pill px-4">Cancelar</a>
                        <button type="submit" class="btn inventario__btn-agregar rounded-pill px-4">
                            <i class="bi bi-check-circle-fill" aria-hidden="true"></i> Guardar cambios
                        </button>
                    </div>
                </form>
            </div>
        </div>

    <?php else: ?>

        <!-- El id no corresponde a ninguna etiqueta (o vino vacío / con letras) -->
        <header class="inventario__hero rounded-4 p-4 p-lg-5 text-center">
            <p class="inventario__eyebrow text-uppercase mb-2">Panel · Editar etiqueta</p>
            <h1 class="h2 fw-bold text-white mb-2">Etiqueta no encontrada</h1>
            <p class="text-white-50 mb-4">La etiqueta que querés editar <strong class="text-white">no existe o ya fue borrada</strong>.</p>
            <a href="index.php?content=admin_etiquetas" class="btn inventario__btn-agregar rounded-pill px-4">
                <i class="bi bi-arrow-left" aria-hidden="true"></i> Volver a etiquetas
            </a>
        </header>

    <?php endif; ?>

</section>
