<?php
require_once __DIR__ . "/Conexion.php";

class Imagen
{

    private int $id;
    private int $producto_id;
    private string $ruta;
    private string $alt;
    private int $orden;

    /**
     * Devuelve todas las imágenes de un producto como objetos Imagen.
     * @param int $productoId ID del producto
     * @return Imagen[] Array de objetos Imagen
     */

    public static function getImagenesPorProducto(int $productoId): array
    {
        $conexion = (new Conexion())->getConexion();
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
     * Get the value of id
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Get the value of producto_id
     */
    public function getProductoId(): int
    {
        return $this->producto_id;
    }

    public function getRuta(): string
    {
        return $this->ruta;
    }

    public function getAlt(): string
    {
        return $this->alt;
    }

    public function getOrden(): int
    {
        return $this->orden;
    }

    /**
     * Set the value of id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setProductoId(int $producto_id): void
    {
        $this->producto_id = $producto_id;
    }

    public function setRuta(string $ruta): void
    {
        $this->ruta = $ruta;
    }

    public function setAlt(string $alt): void
    {
        $this->alt = $alt;
    }

    public function setOrden(int $orden): void
    {
        $this->orden = $orden;
    }
}
