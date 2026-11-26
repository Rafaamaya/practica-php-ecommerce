<?php

/**
 * Carga automáticamente el archivo de una clase la primera vez que se usa.
 *
 * PHP la llama sola (está registrada con spl_autoload_register) con el nombre de la clase.
 * Por eso cada clase tiene que estar en classes/, en un archivo con su mismo nombre
 * (ej: la clase Producto en classes/Producto.php).
 *
 * @param string $className Nombre de la clase que se quiere usar
 * @return void
 */
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
