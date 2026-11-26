<?php

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
     * Devuelve todos los productos del catálogo, con sus etiquetas e imágenes cargadas.
     *
     * @return Producto[] Array de objetos Producto
     */
    public static function getCatalogoCompleto(): array
    {
        $conexion = Conexion::getConexion();
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
     * Devuelve los productos que tienen una etiqueta determinada, con sus etiquetas e imágenes cargadas.
     *
     * Hace un INNER JOIN con la tabla pivot producto_etiqueta.
     *
     * @param int $etiquetaId ID de la etiqueta
     * @return Producto[] Array de objetos Producto
     */
    public static function getPorEtiqueta(int $etiquetaId): array
    {
        $conexion = Conexion::getConexion();
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
     * Busca un producto por su id y le carga sus etiquetas, imágenes y formas de pago.
     *
     * @param int $id ID del producto
     * @return Producto|null Objeto Producto, o null si no existe
     */
    public static function getPorId(int $id): ?Producto
    {
        $conexion = Conexion::getConexion();
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
     * Le carga a cada producto de la lista sus etiquetas.
     *
     * @param Producto[] $productos Productos a completar
     * @return Producto[] Los mismos productos, con su lista de etiquetas cargada
     */
    private static function cargarEtiquetas(array $productos): array
    {
        foreach ($productos as $producto) {
            $producto->etiquetaList = Etiqueta::getPorProducto($producto->getId());
        }
        return $productos;
    }

    /**
     * Le carga a cada producto de la lista sus imágenes.
     *
     * @param Producto[] $productos Productos a completar
     * @return Producto[] Los mismos productos, con su lista de imágenes cargada
     */
    private static function cargarImagenes(array $productos): array
    {
        foreach ($productos as $producto) {
            $producto->imagenList = Imagen::getImagenesPorProducto($producto->getId());
        }
        return $productos;
    }


    /**
     * Devuelve el id del producto.
     *
     * @return int El id del producto
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Devuelve el nombre del producto.
     *
     * @return string El nombre del producto
     */
    public function getNombre(): string
    {
        return $this->nombre;
    }

    /**
     * Devuelve la descripción corta del producto (la que se ve en el catálogo).
     *
     * @return string La descripción corta del producto (la que se ve en el catálogo)
     */
    public function getDescripcion(): string
    {
        return $this->descripcion;
    }

    /**
     * Devuelve el precio del producto.
     *
     * @return string El precio del producto
     */
    public function getPrecio(): string
    {
        return $this->precio;
    }

    /**
     * Devuelve la altura de la figura en centímetros.
     *
     * @return float La altura de la figura en centímetros
     */
    public function getAlturaCm(): float
    {
        return $this->altura_cm;
    }

    /**
     * Devuelve si la figura incluye base (1 = sí, 0 = no).
     *
     * @return int Si la figura incluye base (1 = sí, 0 = no)
     */
    public function getBaseIncluida(): int
    {
        return $this->base_incluida;
    }

    /**
     * Devuelve el acabado de la figura.
     *
     * @return string El acabado de la figura
     */
    public function getAcabado(): string
    {
        return $this->acabado;
    }

    /**
     * Devuelve la edición de la figura.
     *
     * @return string La edición de la figura
     */
    public function getEdicion(): string
    {
        return $this->edicion;
    }

    /**
     * Devuelve la descripción extendida del producto (la que se ve en el detalle).
     *
     * @return string La descripción extendida del producto (la que se ve en el detalle)
     */
    public function getDescripcionExtendida(): string
    {
        return $this->descripcion_extendida;
    }

    /**
     * Asigna el id del producto.
     *
     * @param int $id El id del producto
     * @return void
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * Asigna el nombre del producto.
     *
     * @param string $nombre El nombre del producto
     * @return void
     */
    public function setNombre(string $nombre): void
    {
        $this->nombre = $nombre;
    }

    /**
     * Asigna la descripción corta del producto.
     *
     * @param string $descripcion La descripción corta del producto
     * @return void
     */
    public function setDescripcion(string $descripcion): void
    {
        $this->descripcion = $descripcion;
    }

    /**
     * Asigna el precio del producto.
     *
     * @param string $precio El precio del producto
     * @return void
     */
    public function setPrecio(string $precio): void
    {
        $this->precio = $precio;
    }

    /**
     * Asigna la altura de la figura en centímetros.
     *
     * @param float $alturaCm La altura de la figura en centímetros
     * @return void
     */
    public function setAlturaCm(float $alturaCm): void
    {
        $this->altura_cm = $alturaCm;
    }

    /**
     * Asigna si la figura incluye base (1 = sí, 0 = no).
     *
     * @param int $baseIncluida Si la figura incluye base (1 = sí, 0 = no)
     * @return void
     */
    public function setBaseIncluida(int $baseIncluida): void
    {
        $this->base_incluida = $baseIncluida;
    }

    /**
     * Asigna el acabado de la figura.
     *
     * @param string $acabado El acabado de la figura
     * @return void
     */
    public function setAcabado(string $acabado): void
    {
        $this->acabado = $acabado;
    }

    /**
     * Asigna la edición de la figura.
     *
     * @param string $edicion La edición de la figura
     * @return void
     */
    public function setEdicion(string $edicion): void
    {
        $this->edicion = $edicion;
    }

    /**
     * Asigna la descripción extendida del producto.
     *
     * @param string $descripcionExtendida La descripción extendida del producto
     * @return void
     */
    public function setDescripcionExtendida(string $descripcionExtendida): void
    {
        $this->descripcion_extendida = $descripcionExtendida;
    }

    /**
     * Devuelve las etiquetas del producto.
     *
     * @return Etiqueta[] Array de objetos Etiqueta
     */
    public function getEtiquetaList(): array
    {
        return $this->etiquetaList;
    }

    /**
     * Devuelve las imágenes del producto, ordenadas por el campo orden.
     *
     * @return Imagen[] Array de objetos Imagen
     */
    public function getImagenList(): array
    {
        return $this->imagenList;
    }

    /**
     * Asigna la lista de imágenes del producto.
     *
     * @param Imagen[] $imagenList Array de objetos Imagen
     * @return void
     */
    public function setImagenList(array $imagenList): void
    {
        $this->imagenList = $imagenList;
    }

    /**
     * Devuelve las formas de pago del producto.
     *
     * @return FormaPago[] Array de objetos FormaPago
     */
    public function getPagoList(): array
    {
        return $this->pagoList;
    }
}
