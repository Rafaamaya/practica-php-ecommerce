<?php

class FormaPago
{
    private int $id;
    private string $titulo;
    private string $descripcion;

    /**
     * Devuelve las formas de pago de un producto, con la descripción propia de ese producto.
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

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitulo(): string
    {
        return $this->titulo;
    }

    public function getDescripcion(): string
    {
        return $this->descripcion;
    }
}