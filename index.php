<?php
require_once __DIR__ . "/includes/whitelist.php";
/* require_once __DIR__ . "/data/product_list.php"; */


/* echo "<pre>";
print_r($_GET);
echo "</pre>"; */


/* $content = (isset($_GET['content'])) ? $_GET['content'] : 'home'; */
$seccion = $_GET['content'] ?? 'home'; // Operador de fusión de null (PHP 7+)  

if (array_key_exists($seccion, $white_list) && (file_exists("views/$seccion.php"))) {
    $content = $seccion;
} else {
    $content = '404';
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Figuras de Colección — <?= $white_list[$content]['titulo'] ?? 'Figuras 3D' ?> </title>


    <!-- Bootstrap 5.3 vía CDN (jsDelivr)-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <!-- Bootstrap Icons (librería de íconos, CDN aparte de Bootstrap) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Mi hoja de estilos propia (va después de Bootstrap para poder pisarlo) -->
    <link rel="stylesheet" href="css/index.css">

</head>


<body>

    <!-- ===== NAVBAR ===== -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-tienda">
            <div class="container">
                <a class="navbar-brand" href="index.php?content=home">Figuras 3D</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navMenu">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href=<?= $white_list['home']['url'] ?>>Inicio</a>
                        </li>


                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Productos
                            </a>
                            <ul class="dropdown-menu dropdown-menu-dark">
                                <li><a class="dropdown-item" href=<?= $white_list['products']['url'] . "todo"  ?>>Catálogo</a></li>
                                <li><a class="dropdown-item" href=<?= $white_list['products']['url'] . "nuevo" ?>>Nuevos ingresos</a></li>
                                <li><a class="dropdown-item" href=<?= $white_list['products']['url'] . "oferta"?>>Ofertas</a></li>
                            </ul>
                        </li>


                        <li class="nav-item">
                            <a class="nav-link" href=<?= $white_list['process']['url'] ?>>Nuestro proceso</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href=<?= $white_list['contact']['url'] ?>>Contacto</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main class="container mt-4">
        <?php
        require_once "views/$content.php";
        ?>
    </main>

    <!-- ===== FOOTER ===== -->
    <footer class="bg-dark text-light py-4 mt-4">
        <div class="container">
            <div class="row align-items-center g-4 ">

                <div class="col-12 col-md-7">
                    <h2 class="h4">Figuras de Colección 3D</h2>
                    <p class="mb-1"><strong>Impresas en 3D</strong> y pintadas a mano.</p>
                    <p class="mb-2 text-secondary"><em>Sitio creado con fines educativos.</em></p>
                    <div class="d-flex gap-3 fs-3 justify-content-center justify-content-md-start">
                        <a href="https://www.instagram.com/rafi.amaya/" class="text-light" aria-label="Instagram"
                            target="_blank" rel="noopener noreferrer"><i class="bi bi-instagram"></i></a>
                        <a href="https://www.linkedin.com/in/rafael-amaya/" class="text-light" aria-label="LinkedIn"
                            target="_blank" rel="noopener noreferrer"><i class="bi bi-linkedin"></i></a>
                        <a href="https://x.com/RafaAmaya82" class="text-light" aria-label="X" target="_blank"
                            rel="noopener noreferrer"><i class="bi bi-twitter-x"></i></a>
                    </div>
                </div>

                <div class="col-12 col-md-5 text-center">
                    <img src="img/foto-perfil.jpg" width="250" class="rounded-circle mb-3" alt="Foto de Rafael Amaya">
                    <h3 class="h5">Datos del alumno</h3>
                    <p class="mb-1"><strong>Rafael Amaya</strong></p>
                    <p class="mb-1">Fecha de nacimiento: <em>29/04/1982</em></p>
                    <p class="mb-1">Email: <em>rafa.amaya82@gmail.com</em></p>
                </div>

            </div>
        </div>
    </footer>

    <!-- Bootstrap JS (bundle) vía CDN-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous">
    </script>
</body>

</html>