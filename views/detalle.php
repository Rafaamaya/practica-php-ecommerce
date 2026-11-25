<?php

require_once __DIR__ . "/../includes/funciones.php";
require_once __DIR__ . "/../includes/whitelist.php";
require_once __DIR__ . "/../classes/Producto.php";

$id = (int) ($_GET['id'] ?? 0);

$unproducto = Producto::getPorId($id);




?>
<?php if ($unproducto): ?>
    <div>
        <section class="mb-4">
            <p class="text-uppercase text-muted mb-2"><strong>Detalle de producto</strong></p>
            <h1> <?= $unproducto->getNombre() . " - " . $unproducto->getEdicion(); ?></h1>
            <p class="text-secondary"><?= $unproducto->getDescripcion(); ?></p>
        </section>

        <section class="row gy-4 align-items-start">
            <div class="col-lg-6">
                <div class="row g-3">
                    <?php foreach ($unproducto->getImagenList() as $key => $imagen): ?>
                        <?php if ($key === 0): ?>
                            <div class="col-12">
                                <img src="img/productos/<?= $imagen->getRuta() ?>" class="img-fluid rounded shadow-sm" alt="<?= htmlspecialchars($imagen->getAlt(), ENT_QUOTES, 'UTF-8') ?>">
                            </div>
                        <?php endif; ?>
                        <?php if ($key > 0): ?>
                            <div class="col-6">
                                <img src="img/detalle/<?= $imagen->getRuta() ?>" class="img-fluid rounded shadow-sm" alt="<?= htmlspecialchars($imagen->getAlt(), ENT_QUOTES, 'UTF-8') ?>">
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h2 class="card-title"><?= $unproducto->getNombre(); ?></h2>
                        <p class="fs-3 text-success"><strong><?= $unproducto->getPrecio(); ?></strong></p>
                        <p>Material: <strong>PLA de alta densidad</strong> con pintura acrílica. <?= $unproducto->getBaseIncluida() === 1 ? 'Incluye base para exhibir la figura con estilo.' : 'No incluye base.' ?></p>

                        <ul class="list-group list-group-flush mb-4">
                            <li class="list-group-item">Producción artesanal con acabado único.</li>
                            <li class="list-group-item">Recomendado para coleccionistas y regalos temáticos.</li>
                            <li class="list-group-item">Envío nacional disponible en 7-10 días hábiles.</li>
                        </ul>

                        <a href="#" class="btn btn-primary w-100 mb-2">Comprar ahora</a>
                        <a href="<?= $white_list['products']['url'] . "todo"  ?>" class="btn btn-outline-secondary w-100">Seguir viendo productos</a>
                    </div>
                </div>

                <div class="mt-4">
                    <h3>Opciones de pago</h3>
                    <div class="accordion" id="accordionPagos">
                        <?php foreach ($unproducto->getPagoList() as  $value): ?>
                            <div class="accordion-item">
                                <div class="accordion-header" id="heading<?= $value->getId() ?>">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $value->getId() ?>">
                                        <?= htmlspecialchars($value->getTitulo()) ?>
                                    </button>
                                </div>
                                <div id="collapse<?= $value->getId() ?>" class="accordion-collapse collapse" data-bs-parent="#accordionPagos">
                                    <div class="accordion-body">
                                        <?= $value->getDescripcion() ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>

                    </div>
                </div>
            </div>
        </section>

        <div class="mt-5">
            <div class="row g-4">
                <div class="col-lg-8">
                    <article>
                        <h2>Descripción extendida</h2>
                        <p><?= $unproducto->getDescripcionExtendida(); ?></p>
                    </article>
                    <article class="mt-4">
                        <h2>Cómo cuidarla</h2>
                        <p>Para mantener el acabado, <strong>evitá exponer la figura a la luz solar directa</strong> y limpiá el polvo con un paño suave. El material PLA es resistente, pero recomendamos manipularla con cuidado al moverla de lugar.</p>
                    </article>
                </div>
                <aside class="col-lg-4">
                    <div class="card h-100 bg-light border-0 shadow-sm">
                        <div class="card-body">
                            <h3 class="h5">Características</h3>
                            <ul class="list-unstyled mb-0">
                                <li class="mb-2"><i class="bi bi-check2-circle text-success"></i> <?= $unproducto->getAlturaCm() ?> cm </li>
                                <li class="mb-2"><i class="bi bi-check2-circle text-success"></i> <?= $unproducto->getAcabado() ?></li>
                                <li class="mb-2"><i class="bi bi-check2-circle text-success"></i> <?= $unproducto->getBaseIncluida() === 1 ? "Base incluida" : "No incluye base"  ?></li>
                                <li><i class="bi bi-check2-circle text-success"></i> <?= $unproducto->getEdicion() ?></li>
                            </ul>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </div>
<?php else: ?>
    <section class="my-5 text-center">
        <h1>Producto no encontrado</h1>
        <p>La figura que buscás <strong>no existe o ya no está disponible</strong>.</p>
        <a href="<?= $white_list['products']['url']; ?>" class="btn btn-primary">Ver el catálogo</a>
    </section>
<?php endif; ?>