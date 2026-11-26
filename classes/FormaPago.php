<?php

class FormaPago
{
    private int $id;
    private string $titulo;
    private string $descripcion;

    /**
     * Devuelve las formas de pago de un producto, con la descripción propia de ese producto.
     *
     * Hace un INNER JOIN entre producto_pagos y formas_pago.
     *
     * @param int $productoId ID del producto
     * @return FormaPago[] Array de objetos FormaPago
     */
    public static function getPorProducto(int $productoId): array
    {
        $conexion = Conexion::getConexion();
        $query = "SELECT formas_pago.id, formas_pago.titulo, producto_pagos.descripcion
                  FROM producto_pagos
                  INNER JOIN formas_pago ON formas_pago.id = producto_pagos.forma_pago_id
                  WHERE producto_pagos.producto_id = :producto_id
                  ORDER BY formas_pago.id";
        try {
            $PDOStatement = $conexion->prepare($query);
            $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
            $PDOStatement->execute(['producto_id' => $productoId]);
            return $PDOStatement->fetchAll();
        } catch (Throwable $th) {
            echo "<p>Se generó un error en el siguiente archivo: " . $th->getFile() . " en la línea " . $th->getLine() . "</p>";
            die("Error al obtener las formas de pago. Intenta más tarde.");
        }
    }

    /**
     * Devuelve el id de la forma de pago.
     *
     * @return int El id de la forma de pago
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Devuelve el título de la forma de pago.
     *
     * @return string El título de la forma de pago
     */
    public function getTitulo(): string
    {
        return $this->titulo;
    }

    /**
     * Devuelve la descripción de la forma de pago para este producto.
     *
     * @return string La descripción de la forma de pago para este producto
     */
    public function getDescripcion(): string
    {
        return $this->descripcion;
    }
}