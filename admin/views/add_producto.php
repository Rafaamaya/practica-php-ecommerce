<?php
$etiquetas = Etiqueta::getTodas();
?>

<section class="py-4">

    <!-- ===== ENCABEZADO (mismo estilo que el inventario) ===== -->
    <header class="inventario__hero rounded-4 p-4 mb-4">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
            <div>
                <p class="inventario__eyebrow text-uppercase mb-2">Panel · Nuevo producto</p>
                <h1 class="h2 fw-bold text-white mb-1">Agregar un producto</h1>
                <p class="text-white-50 mb-0">Completá los datos de la figura. Los campos con <strong class="text-white">*</strong> son obligatorios.</p>
            </div>
            <a href="index.php?content=admin_prodcutos" class="btn btn-outline-light rounded-pill px-4">
                <i class="bi bi-arrow-left" aria-hidden="true"></i> Volver al inventario
            </a>
        </div>
    </header>

    <!-- enctype multipart/form-data: hace falta para poder enviar archivos (las imágenes) -->
    <!-- TODO: definir el archivo que procesa el alta (insertar el producto, sus etiquetas y sus imágenes) -->
    <form action="#" method="post" enctype="multipart/form-data" class="card border-0 shadow-sm rounded-4 p-4 p-lg-5">

        <!-- ===== 1. DATOS PRINCIPALES ===== -->
        <fieldset class="mb-4">
            <legend class="formulario__leyenda"><span class="inventario__ficha-icono"><i class="bi bi-tag-fill" aria-hidden="true"></i></span> Datos principales</legend>
            <div class="row g-3">
                <div class="col-md-8">
                    <label for="nombre" class="form-label">Nombre *</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" maxlength="100" placeholder="Ej: Charizard" required>
                </div>
                <div class="col-md-4">
                    <label for="edicion" class="form-label">Edición *</label>
                    <input type="text" class="form-control" id="edicion" name="edicion" maxlength="50" placeholder="Ej: Edición limitada" required>
                </div>
                <div class="col-md-4">
                    <label for="precio" class="form-label">Precio *</label>
                    <div class="input-group">
                        <span class="input-group-text">$</span>
                        <input type="number" class="form-control" id="precio" name="precio" min="0" step="0.01" placeholder="0.00" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="altura_cm" class="form-label">Altura *</label>
                    <div class="input-group">
                        <input type="number" class="form-control" id="altura_cm" name="altura_cm" min="0" step="0.1" placeholder="0.0" required>
                        <span class="input-group-text">cm</span>
                    </div>
                </div>
                <div class="col-md-4 d-flex align-items-end">
                    <div class="form-check form-switch mb-2">
                        <input class="form-check-input" type="checkbox" id="base_incluida" name="base_incluida" value="1">
                        <label class="form-check-label" for="base_incluida">Incluye base</label>
                    </div>
                </div>
                <div class="col-12">
                    <label for="acabado" class="form-label">Acabado *</label>
                    <input type="text" class="form-control" id="acabado" name="acabado" maxlength="150" placeholder="Ej: Pintura acrílica con detalles metalizados" required>
                </div>
            </div>
        </fieldset>

        <!-- ===== 2. DESCRIPCIONES ===== -->
        <fieldset class="mb-4">
            <legend class="formulario__leyenda"><span class="inventario__ficha-icono"><i class="bi bi-card-text" aria-hidden="true"></i></span> Descripciones</legend>
            <div class="row g-3">
                <div class="col-12">
                    <label for="descripcion" class="form-label">Descripción corta *</label>
                    <textarea class="form-control" id="descripcion" name="descripcion" rows="2" maxlength="500" placeholder="Se muestra en la tarjeta del catálogo" required></textarea>
                </div>
                <div class="col-12">
                    <label for="descripcion_extendida" class="form-label">Descripción extendida *</label>
                    <textarea class="form-control" id="descripcion_extendida" name="descripcion_extendida" rows="5" placeholder="Se muestra en el detalle del producto" required></textarea>
                </div>
            </div>
        </fieldset>

        <!-- ===== 3. ETIQUETAS (relación muchos a muchos) ===== -->
        <fieldset class="mb-4">
            <legend class="formulario__leyenda"><span class="inventario__ficha-icono"><i class="bi bi-bookmarks-fill" aria-hidden="true"></i></span> Etiquetas</legend>
            <p class="small text-secondary">Podés elegir <strong>una, varias o ninguna</strong>.</p>
            <!-- name="etiquetas[]": los corchetes hacen que PHP reciba un array con los id elegidos -->
            <div class="d-flex flex-wrap gap-2">
                <?php foreach ($etiquetas as $etiqueta): ?>
                    <input
                        type="checkbox"
                        class="btn-check"
                        id="etiqueta_<?= $etiqueta->getId(); ?>"
                        name="etiquetas[]"
                        value="<?= $etiqueta->getId(); ?>">
                    <label
                        class="btn btn-outline-<?= $etiqueta->getTipo(); ?> btn-sm rounded-pill px-3"
                        for="etiqueta_<?= $etiqueta->getId(); ?>">
                        <?= $etiqueta->getNombre(); ?>
                    </label>
                <?php endforeach; ?>
            </div>
        </fieldset>

        <!-- ===== 4. IMÁGENES (relación uno a muchos) ===== -->
        <fieldset class="mb-4">
            <legend class="formulario__leyenda"><span class="inventario__ficha-icono"><i class="bi bi-images" aria-hidden="true"></i></span> Imágenes</legend>
            <label
                for="imagenes"
                class="form-label">
                Fotos de la figura *
            </label>
            <!-- multiple + name="imagenes[]": permite subir varias fotos a la vez -->
            <input 
                type="file" 
                class="form-control" 
                id="imagenes" 
                name="imagenes[]" 
                accept="image/*" multiple required>
            <p class="form-text mb-0">La <strong>primera</strong> foto es la que se muestra en el catálogo.</p>
        </fieldset>

        <!-- ===== BOTONES ===== -->
        <div class="d-flex flex-column flex-sm-row justify-content-end gap-2 border-top pt-4">
            <a href="index.php?content=admin_prodcutos" class="btn btn-light rounded-pill px-4">Cancelar</a>
            <button type="submit" class="btn inventario__btn-agregar rounded-pill px-4">
                <i class="bi bi-check-circle-fill" aria-hidden="true"></i> Guardar producto
            </button>
        </div>
    </form>
</section>