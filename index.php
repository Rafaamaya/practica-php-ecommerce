<?php
require_once __DIR__ . "/includes/whitelist.php";
require_once __DIR__ . "/classes/Etiqueta.php";
require_once __DIR__ . "/classes/Vista.php";

$seccion = $_GET['content'] ?? 'home'; // Operador de fusión de null (PHP 7+)  
$content = Vista::validarVista($seccion);
$etiquetas = Etiqueta::getTodas();



?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Figuras de Colección — <?= $content->getTitulo() ?> </title>


    <!-- Bootstrap 5.3 vía CDN (jsDelivr)-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <!-- Bootstrap Icons (librería de íconos, CDN aparte de Bootstrap) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Mi hoja de estilos propia (va después de Bootstrap para poder pisarlo) -->
    <link rel="stylesheet" href="css/index.css">

</head>


<!-- d-flex flex-column + min-vh-100: el body ocupa toda la pantalla y apila header, main y footer -->
<body class="d-flex flex-column min-vh-100">

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
                            <a class="nav-link" href="<?= $white_list['home']['url'] ?>">Inicio</a>
                        </li>


                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Productos
                            </a>
                            <ul class="dropdown-menu dropdown-menu-dark">
                                <li><a class="dropdown-item" href="<?= $white_list['products']['url'] . "todo"  ?>">Catálogo</a></li>
                                <?php foreach ($etiquetas as $etiqueta) : ?>
                                    <li><a class="dropdown-item" href="<?= $white_list['products']['url'] . $etiqueta->getId() ?>"><?= $etiqueta->getNombre() ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        </li>


                        <li class="nav-item">
                            <a class="nav-link" href="<?= $white_list['process']['url'] ?>">Nuestro proceso</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= $white_list['contact']['url'] ?>">Contacto</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= $white_list['alumno']['url'] ?>">Alumno</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- flex-grow-1: el main crece y empuja el footer al fondo cuando el contenido es corto -->
    <main class="container mt-4 flex-grow-1">
        <?php
        require_once "views/" . $content->getNombre() . ".php";
        ?>
    </main>

    <!-- ===== FOOTER ===== -->
    <footer class="bg-dark text-light py-4 mt-4">
        <div class="container">
            <div class="row align-items-center g-4 ">

                <div class="col-12 text-center">
                    <h2 class="h4">Figuras de Colección 3D</h2>
                    <p class="mb-1"><strong>Impresas en 3D</strong> y pintadas a mano.</p>
                    <p class="mb-2 text-secondary"><em>Sitio creado con fines educativos.</em></p>
                    <div class="d-flex gap-3 fs-3 justify-content-center">
                        <a href="https://www.instagram.com/rafi.amaya/" class="text-light" aria-label="Instagram"
                            target="_blank" rel="noopener noreferrer"><i class="bi bi-instagram"></i></a>
                        <a href="https://www.linkedin.com/in/rafael-amaya/" class="text-light" aria-label="LinkedIn"
                            target="_blank" rel="noopener noreferrer"><i class="bi bi-linkedin"></i></a>
                        <a href="https://x.com/RafaAmaya82" class="text-light" aria-label="X" target="_blank"
                            rel="noopener noreferrer"><i class="bi bi-twitter-x"></i></a>
                    </div>
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