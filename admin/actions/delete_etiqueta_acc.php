<?php

require_once __DIR__ . "/../../functions/autoload.php";

$id = (int) ($_GET['id'] ?? 0);

$unaEtiqueta = Etiqueta::getPorId($id);

if ($unaEtiqueta) {
    $unaEtiqueta->deleteEtiqueta();
    header("Location: ../index.php?content=admin_etiquetas&status=success");
} else {
    header("Location: ../index.php?content=admin_etiquetas&status=notfound");
}


