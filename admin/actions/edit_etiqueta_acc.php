<?php

require_once __DIR__ . "/../../functions/autoload.php";

$informacion = $_POST;


if (empty($_POST)) {
    header("Location: ../index.php?content=admin_etiquetas");
} else {
    // TODO: la columna nombre es UNIQUE, así que ponerle el nombre de otra etiqueta hace fallar el UPDATE.
    // Manejar ese error y avisarle al usuario (ej: volver al formulario con status=repetida y mostrar
    // "Ya existe una etiqueta con ese nombre") en lugar de cortar con el die() de updateEtiqueta()
    Etiqueta::updateEtiqueta($informacion['id'], $informacion['nombre'], $informacion['tipo']);
    header("Location: ../index.php?content=admin_etiquetas&status=success");
}
