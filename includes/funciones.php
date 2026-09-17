<?php


/**
 * Obtiene los productos desde un archivo JSON del directorio de datos.
 *
 * El nombre recibido debe indicarse sin la extensión `.json`.
 *
 * @param string $file Nombre del archivo JSON ubicado en `../data/`.
 * @return array Productos decodificados como un arreglo asociativo.
 */
function get_productos(string $file ): array
{
    $get_JSON = file_get_contents(__DIR__ . "/../data/".$file.".json");
    $productos = json_decode($get_JSON, true);
    return $productos;
}

/**
 * Filtra los productos del catálogo según su etiqueta.
 *
 * La comparación se realiza ignorando mayúsculas y minúsculas.
 *
 * @param string $etiqueta Etiqueta que se desea buscar.
 * @return array 
 * De productos cuya etiqueta coincide con el valor buscado. En caso de no encontralo retorna un array vacio
 */
function filtrar_etiqueta(string $etiqueta): array
{
    $catalalogoCompleto = get_productos("catalogo");
    $resultado = [];

    foreach ($catalalogoCompleto as $item) {
        if (strtolower($item['etiqueta']) == strtolower($etiqueta)) {
            $resultado[] = $item;
        }
    }
    return $resultado;
}

/**
 * Obtiene el detalle de un producto a partir de su Id.
 *
 * @param int $id Identificador del producto que se desea consultar.
 * @return array|null Datos del producto encontrado o `null` si no existe.
 */
function obtener_detalle_producto (int $id): mixed
{
    $detallesDeProductos = get_productos("detalle_producto");
    $resultado = null;

    foreach ($detallesDeProductos as $item) {
        if ($item["id"] === $id) {
            return $item;
        }
    }

    return $resultado;
}
