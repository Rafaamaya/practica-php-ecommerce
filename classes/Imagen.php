<?php

class Imagen
{

    private int $id;
    private int $producto_id;
    private string $ruta;
    private string $alt;
    private int $orden;

    /**
     * Devuelve todas las imágenes de un producto, ordenadas por el campo orden.
     *
     * @param int $productoId ID del producto
     * @return Imagen[] Array de objetos Imagen
     */
    public static function getImagenesPorProducto(int $productoId): array
    {
        $conexion = Conexion::getConexion();
        $query = "SELECT * FROM imagenes WHERE producto_id = :producto_id ORDER BY orden";
        try {
            $PDOStatement = $conexion->prepare($query);
            $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
            $PDOStatement->execute(['producto_id' => $productoId]);
            return $PDOStatement->fetchAll();
        } catch (Throwable $th) {
            echo "<p>Se generó un error en el siguiente archivo: " . $th->getFile() . " en la línea " . $th->getLine() . "</p>";
            die("Error al obtener las imágenes del producto. Intenta más tarde.");
        }
    }

    /**
     * Devuelve el id de la imagen.
     *
     * @return int El id de la imagen
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Devuelve el id del producto al que pertenece la imagen.
     *
     * @return int El id del producto al que pertenece la imagen
     */
    public function getProductoId(): int
    {
        return $this->producto_id;
    }

    /**
     * Devuelve el nombre del archivo de la imagen.
     *
     * @return string El nombre del archivo de la imagen
     */
    public function getRuta(): string
    {
        return $this->ruta;
    }

    /**
     * Devuelve el texto alternativo de la imagen.
     *
     * @return string El texto alternativo de la imagen
     */
    public function getAlt(): string
    {
        return $this->alt;
    }

    /**
     * Devuelve la posición de la imagen en la galería.
     *
     * @return int La posición de la imagen en la galería
     */
    public function getOrden(): int
    {
        return $this->orden;
    }

    /**
     * Asigna el id de la imagen.
     *
     * @param int $id El id de la imagen
     * @return void
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * Asigna el id del producto al que pertenece la imagen.
     *
     * @param int $producto_id El id del producto al que pertenece la imagen
     * @return void
     */
    public function setProductoId(int $producto_id): void
    {
        $this->producto_id = $producto_id;
    }

    /**
     * Asigna el nombre del archivo de la imagen.
     *
     * @param string $ruta El nombre del archivo de la imagen
     * @return void
     */
    public function setRuta(string $ruta): void
    {
        $this->ruta = $ruta;
    }

    /**
     * Asigna el texto alternativo de la imagen.
     *
     * @param string $alt El texto alternativo de la imagen
     * @return void
     */
    public function setAlt(string $alt): void
    {
        $this->alt = $alt;
    }

    /**
     * Asigna la posición de la imagen en la galería.
     *
     * @param int $orden La posición de la imagen en la galería
     * @return void
     */
    public function setOrden(int $orden): void
    {
        $this->orden = $orden;
    }
}
