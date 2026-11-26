<?php

require_once __DIR__ . "/../../functions/autoload.php";

$postData = $_POST;

if (empty($_POST)) {
    header("Location: ../index.php?content=add_etiqueta");
} else {

    // TODO: la columna nombre es UNIQUE, así que una etiqueta repetida hace fallar el INSERT.
    // Manejar ese error y avisarle al usuario (ej: volver al formulario con status=repetida y mostrar
    // "Ya existe una etiqueta con ese nombre") en lugar de cortar con el die() de insertEtiqueta()
    Etiqueta::insertEtiqueta($postData['nombre'], $postData['tipo']);
    header("Location: ../index.php?content=admin_etiquetas&status=success");
}
