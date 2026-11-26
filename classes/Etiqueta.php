<?php

class Etiqueta
{
    private int $id;
    private string $nombre;
    private string $tipo;





    /**
     * Devuelve todas las etiquetas ordenadas por id.
     *
     * Se usa para armar el menú de filtros y el listado del panel.
     *
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
     * Busca una etiqueta por su id.
     *
     * @param int $id ID de la etiqueta
     * @return Etiqueta|null Objeto Etiqueta, o null si no existe
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
     * Devuelve las etiquetas asignadas a un producto.
     *
     * Hace un INNER JOIN con la tabla pivot producto_etiqueta.
     *
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
     *
     * @param string $nombre Nombre de la etiqueta (único, hasta 30 caracteres)
     * @param string $tipo Color de Bootstrap de la etiqueta (success, danger, etc.)
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
     * Actualiza el nombre y el color de una etiqueta existente.
     *
     * @param int $id ID de la etiqueta a actualizar
     * @param string $nombre Nuevo nombre de la etiqueta
     * @param string $tipo Nuevo color de Bootstrap de la etiqueta
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
     * Elimina esta etiqueta de la base de datos.
     *
     * Primero la quita de todos los productos que la tienen (tabla producto_etiqueta),
     * porque la FK etiqueta_id es RESTRICT y no deja borrar una etiqueta en uso.
     * Los productos no se borran: solo pierden esta etiqueta.
     *
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



    /**
     * Devuelve el id de la etiqueta.
     *
     * @return int El id de la etiqueta
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Devuelve el nombre de la etiqueta.
     *
     * @return string El nombre de la etiqueta
     */
    public function getNombre(): string
    {
        return $this->nombre;
    }

    /**
     * Devuelve el color de Bootstrap de la etiqueta (success, danger, etc.).
     *
     * @return string El color de Bootstrap de la etiqueta (success, danger, etc.)
     */
    public function getTipo(): string
    {
        return $this->tipo;
    }
}
