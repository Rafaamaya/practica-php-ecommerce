<?php
// Colores de Bootstrap que puede usar una etiqueta: el valor se guarda en la columna "tipo"
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

    <!-- ===== ENCABEZADO (mismo estilo que el resto del panel) ===== -->
    <header class="inventario__hero rounded-4 p-4 mb-4">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
            <div>
                <p class="inventario__eyebrow text-uppercase mb-2">Panel · Nueva etiqueta</p>
                <h1 class="h2 fw-bold text-white mb-1">Agregar una etiqueta</h1>
                <p class="text-white-50 mb-0">Elegí un <strong class="text-white">nombre corto</strong> y el color con el que se va a ver en el catálogo.</p>
            </div>
            <a href="index.php?content=admin_etiquetas" class="btn btn-outline-light rounded-pill px-4">
                <i class="bi bi-arrow-left" aria-hidden="true"></i> Volver a etiquetas
            </a>
        </div>
    </header>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- TODO: definir el archivo que procesa el alta de la etiqueta -->
            <form action="#" method="post" class="card border-0 shadow-sm rounded-4 p-4 p-lg-5">

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
                        placeholder="Ej: Preventa"
                        required>
                    <p class="form-text mb-0">Hasta <strong>30 caracteres</strong>. No puede repetirse con otra etiqueta.</p>
                </fieldset>

                <!-- ===== 2. COLOR ===== -->
                <fieldset class="mb-4">
                    <legend class="formulario__leyenda"><span class="inventario__ficha-icono"><i class="bi bi-palette-fill" aria-hidden="true"></i></span> Color *</legend>
                    <p class="small text-secondary">Así se va a ver la etiqueta en las <em>tarjetas del catálogo</em>.</p>

                    <!-- Radios con el mismo name="tipo": solo se puede elegir un color -->
                    <div class="row g-2">
                        <?php foreach ($colores as $tipo => $nombreColor): ?>
                            <div class="col-6 col-md-4">
                                <input
                                    type="radio"
                                    class="btn-check"
                                    name="tipo"
                                    id="tipo_<?= $tipo; ?>"
                                    value="<?= $tipo; ?>"
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
                        <i class="bi bi-check-circle-fill" aria-hidden="true"></i> Guardar etiqueta
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>