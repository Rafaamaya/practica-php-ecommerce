<?php

require_once __DIR__ . "/Conexion.php";

class Producto
{

    private int $id;
    private string $nombre;
    private string $imagen;
    private string $alt;
    private string $etiqueta = ""; // boorr proximamente
    private string $tipoEtiqueta = ""; // boorr proximamente
    private string $descripcion;
    private string $precio;
    private float $altura_cm;
    private int $base_incluida;
    private string $acabado;
    private string $edicion;
    private string $descripcion_extendida;


    public static function getCatalogoCompleto(): array
    {
        $conexion = (new Conexion())->getConexion();
        $query = "SELECT p.*, i.ruta AS imagen, i.alt
          FROM productos p
          LEFT JOIN imagenes i ON i.producto_id = p.id AND i.orden = 1
          ORDER BY p.id";
        try {
            $PDOStatement = $conexion->prepare($query);
            $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
            $PDOStatement->execute();
            $productos = $PDOStatement->fetchAll();
            return $productos;
        } catch (Throwable $th) {
            echo "<p>Se generó un error en el siguiente archivo: " . $th->getFile() . " en la línea " . $th->getLine() . "</p>";
            die("Error al ejecutar la consulta en la BD estamos trabajando para solucionarlo. Intenta más tarde.");
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
     * Get the value of nombre
     */
    public function getNombre(): string
    {
        return $this->nombre;
    }

    /**
     * Get the value of imagen
     */
    public function getImagen(): string
    {
        return $this->imagen;
    }

    /**
     * Get the value of alt
     */
    public function getAlt(): string
    {
        return $this->alt;
    }

    /**
     * Get the value of etiqueta
     */
    public function getEtiqueta(): ?string
    {
        return $this->etiqueta;
    }

    /**
     * Get the value of tipoEtiqueta
     */
    public function getTipoEtiqueta(): ?string
    {
        return $this->tipoEtiqueta;
    }

    /**
     * Get the value of descripcion
     */
    public function getDescripcion(): string
    {
        return $this->descripcion;
    }

    /**
     * Get the value of precio
     */
    public function getPrecio(): string
    {
        return $this->precio;
    }

    public function getAlturaCm(): float
    {
        return $this->altura_cm;
    }

    public function getBaseIncluida(): int
    {
        return $this->base_incluida;
    }

    public function getAcabado(): string
    {
        return $this->acabado;
    }

    public function getEdicion(): string
    {
        return $this->edicion;
    }

    public function getDescripcionExtendida(): string
    {
        return $this->descripcion_extendida;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setNombre(string $nombre): void
    {
        $this->nombre = $nombre;
    }

    public function setImagen(string $imagen): void
    {
        $this->imagen = $imagen;
    }

    public function setAlt(string $alt): void
    {
        $this->alt = $alt;
    }

    public function setEtiqueta(string $etiqueta): void
    {
        $this->etiqueta = $etiqueta;
    }

    public function setTipoEtiqueta(string $tipoEtiqueta): void
    {
        $this->tipoEtiqueta = $tipoEtiqueta;
    }

    public function setDescripcion(string $descripcion): void
    {
        $this->descripcion = $descripcion;
    }

    public function setPrecio(string $precio): void
    {
        $this->precio = $precio;
    }

    public function setAlturaCm(float $alturaCm): void
    {
        $this->altura_cm = $alturaCm;
    }

    public function setBaseIncluida(int $baseIncluida): void
    {
        $this->base_incluida = $baseIncluida;
    }

    public function setAcabado(string $acabado): void
    {
        $this->acabado = $acabado;
    }

    public function setEdicion(string $edicion): void
    {
        $this->edicion = $edicion;
    }

    public function setDescripcionExtendida(string $descripcionExtendida): void
    {
        $this->descripcion_extendida = $descripcionExtendida;
    }
}
