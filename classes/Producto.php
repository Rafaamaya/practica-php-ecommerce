<?php

require_once __DIR__ . "/Conexion.php";
require_once __DIR__ . "/Etiqueta.php";

class Producto
{

    private int $id;
    private string $nombre;
    private string $imagen;
    private string $alt;
    private string $descripcion;
    private array $etiquetaList = [];
    private string $precio;
    private float $altura_cm;
    private int $base_incluida;
    private string $acabado;
    private string $edicion;
    private string $descripcion_extendida;


    public static function getCatalogoCompleto(): array
    {
        $conexion = (new Conexion())->getConexion();
        $query = "SELECT productos.*, imagenes.ruta AS imagen, imagenes.alt
          FROM productos
          LEFT JOIN imagenes ON imagenes.producto_id = productos.id AND imagenes.orden = 1
          ORDER BY productos.id";
        try {
            $PDOStatement = $conexion->prepare($query);
            $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
            $PDOStatement->execute();
            $productos = $PDOStatement->fetchAll();
            $productos = self::cargarEtiquetas($productos);
            return $productos;
        } catch (Throwable $th) {
            echo "<p>Se generó un error en el siguiente archivo: " . $th->getFile() . " en la línea " . $th->getLine() . "</p>";
            die("Error al ejecutar la consulta en la BD estamos trabajando para solucionarlo. Intenta más tarde.");
        }
    }

    /**
     * Devuelve los productos que tienen una etiqueta determinada.
     * @param int $etiquetaId ID de la etiqueta
     * @return Producto[]
     */
    public static function getPorEtiqueta(int $etiquetaId): array
    {
        $conexion = (new Conexion())->getConexion();
        $query = "SELECT productos.*, imagenes.ruta AS imagen, imagenes.alt
                  FROM productos
                  INNER JOIN producto_etiqueta ON producto_etiqueta.producto_id = productos.id
                  LEFT JOIN imagenes ON imagenes.producto_id = productos.id AND imagenes.orden = 1
                  WHERE producto_etiqueta.etiqueta_id = :etiqueta_id
                  ORDER BY productos.id";
        try {
            $PDOStatement = $conexion->prepare($query);
            $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
            $PDOStatement->execute(['etiqueta_id' => $etiquetaId]);
            $productos = $PDOStatement->fetchAll();
            $productos = self::cargarEtiquetas($productos);
            return $productos;
        } catch (Throwable $th) {
            echo "<p>Se generó un error en el siguiente archivo: " . $th->getFile() . " en la línea " . $th->getLine() . "</p>";
            die("Error al filtrar los productos. Intenta más tarde.");
        }
    }

    /**
     * Le carga a cada producto su lista de etiquetas.
     * @param Producto[] $productos
     * @return Producto[]
     */
    private static function cargarEtiquetas(array $productos): array
    {
        foreach ($productos as $producto) {
            $producto->etiquetaList = Etiqueta::getPorProducto($producto->getId());
        }
        return $productos;
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

    public function getEtiquetaList(): array
    {
        return $this->etiquetaList;
    }
}
