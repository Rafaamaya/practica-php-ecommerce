<?php

/**
 * Clase de conexión a la base de datos
 */

class Conexion
{

    private const DB_SERVER = 'localhost';
    private const DB_USER = 'root';
    private const DB_PASSWORD = '';
    private const DB_NAME = 'tiendita_db';
    private const DB_DSN = 'mysql:host=' . self::DB_SERVER . ';dbname=' . self::DB_NAME;
    private PDO $conexion;

    /**
     * Método para obtener la conexión a la base de datos
     *
     * @return PDO Conexión a la base de datos
     */

    public function getConexion(): PDO
    {
        try {
            $this->conexion = new PDO(self::DB_DSN, self::DB_USER, self::DB_PASSWORD);
        } catch (\Throwable $th) {
            echo "<p>Se generó un error en el siguiente archivo: " . $th->getFile() . " en la línea " . $th->getLine() . "</p>";
            die("Error al conectar a la base de datos. Estamos trabajando para solucionarlo. Intenta más tarde.");
        }

        return $this->conexion;
    }
}