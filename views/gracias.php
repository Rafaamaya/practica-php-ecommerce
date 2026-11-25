<?php
// Si se entra directo por la URL, sin enviar el formulario, no hay datos para mostrar
// TODO: en lugar de este mensaje, mostrar la página 404 (views/404.php)
if (empty($_POST)) {
    echo '<section class="py-5"><h1 class="h2">No hay ningún mensaje</h1>';
    echo '<p>Primero tenés que <a href="index.php?content=contact"><strong>completar el formulario de contacto</strong></a>.</p></section>';
    return;
}

$nombre     = $_POST['nombre'];
$telefono   = $_POST['telefono'] ?? '';
$email      = $_POST['email'];
$comentario = $_POST['comentario'];
?>

<section class="py-5">
    <h1>¡Gracias por escribirnos, <?= htmlspecialchars($nombre); ?>!</h1>
    <p>Recibimos tu mensaje y te vamos a responder a <strong><?= htmlspecialchars($email); ?></strong> a la brevedad.</p>

    <div class="card shadow-sm border-0 my-4">
        <div class="card-body">
            <h2 class="h5">Resumen de tu consulta</h2>
            <ul class="list-unstyled mb-0">
                <li><strong>Nombre:</strong> <?= htmlspecialchars($nombre); ?></li>
                <?php if ($telefono !== ''): ?>
                    <li><strong>Teléfono:</strong> <?= htmlspecialchars($telefono); ?></li>
                <?php endif; ?>
                <li><strong>Email:</strong> <?= htmlspecialchars($email); ?></li>
                <li><strong>Comentario:</strong> <em><?= nl2br(htmlspecialchars($comentario)); ?></em></li>
            </ul>
        </div>
    </div>

    <a href="index.php?content=products" class="btn btn-primary">Ver el catálogo</a>
</section>
