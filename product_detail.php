<?php

require_once __DIR__ . "/includes/funciones.php";

echo "<pre>";
print_r($_GET);
echo "</pre>";

$id = $_GET['id'] ?? null;

$item = obtener_detalle_producto($id);

echo "<pre>";
print_r($item);
echo "</pre>";

?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle del producto — Figuras de Colección 3D</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/detalle.css">
</head>

<body>

    <header>
        <nav class="navbar navbar-expand-lg navbar-tienda">
            <div class="container">
                <a class="navbar-brand" href="index.php">Figuras 3D</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navMenu">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item"><a class="nav-link" href="index.php">Inicio</a></li>
                        <!--                         <li class="nav-item"><a class="nav-link" href="index.html#productos">Productos</a></li>
                        <li class="nav-item"><a class="nav-link" href="index.html#libre">Nuestro proceso</a></li>
                        <li class="nav-item"><a class="nav-link" href="index.html#contacto">Contacto</a></li> -->
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main class="container py-5">
        <section class="mb-5">
            <p class="text-uppercase text-muted mb-2"><strong>Detalle de producto</strong></p>
            <h1> <?= $item["nombre"]; ?> — Edición premium</h1>
            <p class="text-secondary"><strong>Figura de colección impresa en 3D y pintada a mano</strong>, con detalles realistas y <em>base transparente incluida</em>.</p>
        </section>

        <section class="row gy-4 align-items-start">
            <div class="col-lg-6">
                <div class="row g-3">
                    <div class="col-12">
                        <img src= <?= $item["imagenes"][0]["ruta"] ?> class="img-fluid rounded shadow-sm" alt="Figura de RoboCop">
                    </div>
                    <div class="col-6">
                        <img src= <?= $item["imagenes"][1]["ruta"] ?> class="img-fluid rounded shadow-sm" alt="Figura de RoboCop, vista frontal con arma">
                    </div>
                    <div class="col-6">
                        <img src= <?= $item["imagenes"][2]["ruta"] ?> class="img-fluid rounded shadow-sm" alt="Figura de RoboCop, vista frontal completa">
                    </div>
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

                        <a href="index.html#productos" class="btn btn-primary w-100 mb-2">Comprar ahora</a>
                        <a href="index.html" class="btn btn-outline-secondary w-100">Seguir viendo productos</a>
                    </div>
                </div>

                <div class="mt-4">
                    <h3>Opciones de pago</h3>
                    <div class="accordion" id="accordionPagos">
                        <div class="accordion-item">
                            <div class="accordion-header" id="headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
                                    Pago único con tarjeta
                                </button>
                            </div>
                            <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionPagos">
                                <div class="accordion-body">
                                    Aceptamos tarjetas de crédito y débito de todas las marcas principales. Pago seguro con encriptación SSL.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <div class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo">
                                    Financiación en cuotas
                                </button>
                            </div>
                            <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionPagos">
                                <div class="accordion-body">
                                    Hasta 3 cuotas sin interés según el banco. Opción de 6 cuotas con interés fijo para compras superiores a $500.000.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <div class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree">
                                    Envío y retiro
                                </button>
                            </div>
                            <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionPagos">
                                <div class="accordion-body">
                                    Retiro en punto acordado o envío con seguimiento. Embalaje seguro para que la figura llegue sin golpes.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="mt-5">
            <div class="row g-4">
                <div class="col-lg-8">
                    <article>
                        <h2>Descripción extendida</h2>
                        <p>RoboCop es una figura de colección diseñada para exhibirse en estanterías y escritorios. Su <em>pose dinámica</em> y los detalles del casco, la armadura y el bláster lo hacen ideal para fans del cine ochentoso y la ciencia ficción.</p>
                        <p>La base transparente incluye un soporte adicional para mayor estabilidad. Cada figura es pintada a mano, por lo que puede presentar ligeras variaciones que aumentan su <strong>carácter artesanal</strong>.</p>
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
                                <li class="mb-2"><i class="bi bi-check2-circle text-success"></i> Altura: 20 cm</li>
                                <li class="mb-2"><i class="bi bi-check2-circle text-success"></i> Material: PLA + pintura acrílica</li>
                                <li class="mb-2"><i class="bi bi-check2-circle text-success"></i> Base incluida</li>
                                <li><i class="bi bi-check2-circle text-success"></i> Edición limitada</li>
                            </ul>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </main>

    <footer class="bg-dark text-light py-4 mt-5">
        <div class="container text-center">
            <p class="mb-1"><strong>Figuras de Colección 3D</strong> — Página de detalle del producto</p>
            <p class="mb-0"><em>Proyecto educativo de Interacción con Dispositivos Móviles</em></p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>