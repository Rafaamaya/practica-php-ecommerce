<?php

require_once __DIR__ . "/Conexion.php";
require_once __DIR__ . "/Etiqueta.php";
require_once __DIR__ . "/Imagen.php";
require_once __DIR__ . "/FormaPago.php";

class Producto
{

    private int $id;
    private string $nombre;
    private array $imagenList = [];
    private array $etiquetaList = [];
    private array $pagoList = [];
    private string $descripcion;
    private string $precio;
    private float $altura_cm;
    private string $acabado;
    private int $base_incluida;
    private string $edicion;
    private string $descripcion_extendida;


    /**
     * Devuelve todos los productos de la base de datos como objetos Producto.
     * @return Producto[] Array de objetos Producto
     */
    public static function getCatalogoCompleto(): array
    {
        $conexion = (new Conexion())->getConexion();
        $query = "SELECT *
                  FROM productos
                  ORDER BY productos.id";
        try {
            $PDOStatement = $conexion->prepare($query);
            $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
            $PDOStatement->execute();
            $productos = $PDOStatement->fetchAll();
            $productos = self::cargarEtiquetas($productos);
            $productos = self::cargarImagenes($productos);
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
        $query = "SELECT productos.*
                  FROM productos
                  INNER JOIN producto_etiqueta ON producto_etiqueta.producto_id = productos.id
                  WHERE producto_etiqueta.etiqueta_id = :etiqueta_id
                  ORDER BY productos.id";
        try {
            $PDOStatement = $conexion->prepare($query);
            $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
            $PDOStatement->execute(['etiqueta_id' => $etiquetaId]);
            $productos = $PDOStatement->fetchAll();
            $productos = self::cargarEtiquetas($productos);
            $productos = self::cargarImagenes($productos);

            return $productos;
        } catch (Throwable $th) {
            echo "<p>Se generó un error en el siguiente archivo: " . $th->getFile() . " en la línea " . $th->getLine() . "</p>";
            die("Error al filtrar los productos. Intenta más tarde.");
        }
    }

    /**
     * Devuelve un producto por su ID.
     * @param int $id ID del producto
     * @return Producto|null Objeto Producto o null si no se encuentra
     */
    public static function getPorId(int $id): ?Producto
    {
        $conexion = (new Conexion())->getConexion();
        $query = "SELECT *
                  FROM productos
                  WHERE id = :id";
        try {
            $PDOStatement = $conexion->prepare($query);
            $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
            $PDOStatement->execute(['id' => $id]);
            $producto = $PDOStatement->fetch();
            if ($producto) {
                $producto->etiquetaList = Etiqueta::getPorProducto($producto->getId());
                $producto->imagenList = Imagen::getImagenesPorProducto($producto->getId());
                $producto->pagoList = FormaPago::getPorProducto($producto->getId());
            }
            return $producto ?: null;
        } catch (Throwable $th) {
            echo "<p>Se generó un error en el siguiente archivo: " . $th->getFile() . " en la línea " . $th->getLine() . "</p>";
            die("Error al obtener el producto. Intenta más tarde.");
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

    private static function cargarImagenes(array $productos): array
    {
        foreach ($productos as $producto) {
            $producto->imagenList = Imagen::getImagenesPorProducto($producto->getId());
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

    public function getImagenList(): array
    {
        return $this->imagenList;
    }

    public function setImagenList(array $imagenList): void
    {
        $this->imagenList = $imagenList;
    }

    /**
     * @return FormaPago[] Formas de pago del producto
     */
    public function getPagoList(): array
    {
        return $this->pagoList;
    }
}
