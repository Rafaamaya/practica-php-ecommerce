<?php

class Etiqueta
{
    private int $id;
    private string $nombre;
    private string $tipo;





    /**
     * Devuelve todas las etiquetas (para el menú y, más adelante, para el backend).
     * @return Etiqueta[] Array de objetos Etiqueta
     */
    public static function getTodas(): array
    {
        $conexion = Conexion::getConexion();
        $query = "SELECT * FROM etiquetas ORDER BY id";
        try {
            $PDOStatement = $conexion->prepare($query);
            $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
            $PDOStatement->execute();
            return $PDOStatement->fetchAll();
        } catch (Throwable $th) {
            echo "<p>Se generó un error en el siguiente archivo: " . $th->getFile() . " en la línea " . $th->getLine() . "</p>";
            die("Error al obtener las etiquetas. Intenta más tarde.");
        }
    }

    /**
     * Devuelve una etiqueta por su id, o null si no existe.
     * @param int $id ID de la etiqueta
     * @return Etiqueta|null
     */
    public static function getPorId(int $id): ?Etiqueta
    {
        $conexion = Conexion::getConexion();
        $query = "SELECT * FROM etiquetas WHERE id = :id";
        try {
            $PDOStatement = $conexion->prepare($query);
            $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
            $PDOStatement->execute(['id' => $id]);
            $etiqueta = $PDOStatement->fetch();
            return $etiqueta ?: null;
        } catch (Throwable $th) {
            echo "<p>Se generó un error en el siguiente archivo: " . $th->getFile() . " en la línea " . $th->getLine() . "</p>";
            die("Error al obtener la etiqueta. Intenta más tarde.");
        }
    }

    /**
     * Devuelve las etiquetas de un producto como objetos Etiqueta.
     * @param int $productoId ID del producto
     * @return Etiqueta[] Array de objetos Etiqueta
     */
    public static function getPorProducto(int $productoId): array
    {
        $conexion = Conexion::getConexion();
        $query = "SELECT etiquetas.*
          FROM etiquetas
          INNER JOIN producto_etiqueta ON producto_etiqueta.etiqueta_id = etiquetas.id
          WHERE producto_etiqueta.producto_id = :producto_id
          ORDER BY etiquetas.id";
        try {
            $PDOStatement = $conexion->prepare($query);
            $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
            $PDOStatement->execute(['producto_id' => $productoId]);
            return $PDOStatement->fetchAll();
        } catch (Throwable $th) {
            echo "<p>Se generó un error en el siguiente archivo: " . $th->getFile() . " en la línea " . $th->getLine() . "</p>";
            die("Error al obtener las etiquetas. Intenta más tarde.");
        }
    }

    /**
     * Inserta una nueva etiqueta en la base de datos.
     * @param string $nombre Nombre de la etiqueta
     * @param string $tipo Tipo de la etiqueta (color)
     * @return bool True si se insertó correctamente, false en caso contrario
     */
    public static function insertEtiqueta(string $nombre, string $tipo): bool
    {
        $conexion = Conexion::getConexion();
        $query = "INSERT INTO etiquetas (nombre, tipo) VALUES (:nombre, :tipo)";
        try {
            $PDOStatement = $conexion->prepare($query);
            return $PDOStatement->execute(['nombre' => $nombre, 'tipo' => $tipo]);
        } catch (Throwable $th) {
            echo "<p>Se generó un error en el siguiente archivo: " . $th->getFile() . " en la línea " . $th->getLine() . "</p>";
            die("Error al insertar la etiqueta. Intenta más tarde.");
        }
    }

    /**
     * Actualiza una etiqueta existente en la base de datos.
     * @param int $id ID de la etiqueta
     * @param string $nombre Nombre de la etiqueta
     * @param string $tipo Tipo de la etiqueta (color)
     * @return bool True si se actualizó correctamente, false en caso contrario
     */
    public static function updateEtiqueta(int $id, string $nombre, string $tipo): bool
    {
        $conexion = Conexion::getConexion();
        $query = "UPDATE etiquetas SET nombre = :nombre, tipo = :tipo WHERE id = :id";
        try {
            $PDOStatement = $conexion->prepare($query);
            return $PDOStatement->execute(['id' => $id, 'nombre' => $nombre, 'tipo' => $tipo]);
        } catch (Throwable $th) {
            echo "<p>Se generó un error en el siguiente archivo: " . $th->getFile() . " en la línea " . $th->getLine() . "</p>";
            die("Error al actualizar la etiqueta. Intenta más tarde.");
        }
    }

    /**
     * Elimina la etiqueta de la base de datos.
     * Primero la quita de todos los productos que la tienen (tabla producto_etiqueta),
     * porque la FK etiqueta_id es RESTRICT y no deja borrar una etiqueta en uso.
     * Los productos no se borran: solo pierden esta etiqueta.
     * @return bool True si se eliminó correctamente, false en caso contrario
     */
    public function deleteEtiqueta(): bool
    {
        $conexion = Conexion::getConexion();
        try {
            // 1) Quitar la etiqueta de todos los productos (borra solo las filas de la tabla pivot)
            $query = "DELETE FROM producto_etiqueta WHERE etiqueta_id = :id";
            $PDOStatement = $conexion->prepare($query);
            $PDOStatement->execute(['id' => $this->id]);

            // 2) Ahora que nadie la usa, borrar la etiqueta
            $query = "DELETE FROM etiquetas WHERE id = :id";
            $PDOStatement = $conexion->prepare($query);
            return $PDOStatement->execute(['id' => $this->id]);
        } catch (Throwable $th) {
            echo "<p>Se generó un error en el siguiente archivo: " . $th->getFile() . " en la línea " . $th->getLine() . "</p>";
            die("Error al eliminar la etiqueta. Intenta más tarde.");
        }
    }



    public function getId(): int
    {
        return $this->id;
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function getTipo(): string
    {
        return $this->tipo;
    }
}
