<?php

function autoloadClasses(string $className): void
{
    $archivoDeClase = __DIR__ . "/../classes/$className.php";
    if (file_exists($archivoDeClase)) {
        require_once $archivoDeClase;
    } else {
        die("Error: No se pudo cargar la clase '$className'. Archivo no encontrado: $archivoDeClase");
    }

}

spl_autoload_register('autoloadClasses');
