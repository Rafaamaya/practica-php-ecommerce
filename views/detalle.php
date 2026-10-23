<?php

require_once __DIR__ . "/../includes/funciones.php";
require_once __DIR__ . "/../includes/whitelist.php";


/* echo "<pre>";
print_r($_GET);
echo "</pre>"; */

$id = $_GET['id'] ?? null;

$item = obtener_detalle_producto($id);

/* echo "<pre>";
print_r($item);
echo "</pre>"; */

?>


<div>
    <section class="mb-4">
        <p class="text-uppercase text-muted mb-2"><strong>Detalle de producto</strong></p>
        <h1> <?= $item["nombre"]; ?> — Edición premium</h1>
        <p class="text-secondary"><strong>Figura de colección impresa en 3D y pintada a mano</strong>, con detalles realistas y <em>base transparente incluida</em>.</p>
    </section>

    <section class="row gy-4 align-items-start">
        <div class="col-lg-6">
            <div class="row g-3">
                <?php foreach ($item["imagenes"] as $key => $imagen): ?>
                    <?php if ($key === 0): ?>
                        <div class="col-12">
                            <img src="img/productos/<?= $item["imagenes"][$key]["ruta"] ?>" class="img-fluid rounded shadow-sm" alt="<?= htmlspecialchars($item["imagenes"][0]["alt"], ENT_QUOTES, 'UTF-8') ?>">
                        </div>
                    <?php endif; ?>
                    <?php if ($key > 0): ?>
                        <div class="col-6">
                            <img src="img/detalle/<?= $item["imagenes"][$key]["ruta"] ?>" class="img-fluid rounded shadow-sm" alt="<?= htmlspecialchars($item["imagenes"][$key]["alt"], ENT_QUOTES, 'UTF-8') ?>">
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h2 class="card-title"><?= $item["nombre"]; ?></h2>
                    <p class="text-muted"><em>Edición limitada</em> inspirada en el clásico de Detroit. Altura aproximada 20 cm.</p>
                    <p class="fs-3 text-success"><strong><?= $item["precio"] ?></strong></p>
                    <p>Material: <strong>PLA de alta densidad</strong> con pintura acrílica. Incluye base transparente para exhibir la figura con estilo.</p>

                    <ul class="list-group list-group-flush mb-4">
                        <li class="list-group-item">Producción artesanal con acabado único.</li>
                        <li class="list-group-item">Recomendado para coleccionistas y regalos temáticos.</li>
                        <li class="list-group-item">Envío nacional disponible en 7-10 días hábiles.</li>
                    </ul>

                    <a href="#" class="btn btn-primary w-100 mb-2">Comprar ahora</a>
                    <a href=<?= $white_list['products']['url'] . "todo"  ?> class="btn btn-outline-secondary w-100">Seguir viendo productos</a>
                </div>
            </div>

            <div class="mt-4">
                <h3>Opciones de pago</h3>
                <div class="accordion" id="accordionPagos">
                    <?php foreach ($item["pagos"] as $key =>  $value): ?>
                        <div class="accordion-item">
                            <div class="accordion-header" id="heading<?= $key ?>">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $key ?>">
                                    <?= htmlspecialchars($value["titulo"]) ?>
                                </button>
                            </div>
                            <div id="collapse<?= $key ?>" class="accordion-collapse collapse" data-bs-parent="#accordionPagos">
                                <div class="accordion-body">
                                    <?= $value["descripcion"] ?>
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
                    <P><?= $item["descripcion_extendida"] ?></P>
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
                            <li class="mb-2"><i class="bi bi-check2-circle text-success"></i> <?= $item["altura"] ?> </li>
                            <li class="mb-2"><i class="bi bi-check2-circle text-success"></i> <?= $item["acabado"] ?></li>
                            <li class="mb-2"><i class="bi bi-check2-circle text-success"></i> <?= $item["base_incluida"] ? "Base incluida" : "No incluye base"  ?></li>
                            <li><i class="bi bi-check2-circle text-success"></i> <?= $item["edicion"] ?></li>
                        </ul>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</div>