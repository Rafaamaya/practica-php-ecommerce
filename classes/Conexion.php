<?php

class Conexion
{

    private const DB_SERVER = 'localhost';
    private const DB_USER = 'root';
    private const DB_PASSWORD = '';
    private const DB_NAME = 'tiendita_db';
    private const DB_DSN = 'mysql:host=' . self::DB_SERVER . ';dbname=' . self::DB_NAME;
    private static ?PDO $conexion = null;

    /**
     * Crea la conexión PDO y la guarda en la propiedad estática $conexion.
     *
     * Si no se puede conectar, muestra un mensaje de error y corta la ejecución.
     *
     * @return void
     */
    private static function conectar():void
    {
        try {
            self::$conexion = new PDO(self::DB_DSN, self::DB_USER, self::DB_PASSWORD);
        } catch (\Throwable $th) {
            echo "<p>Se generó un error en el siguiente archivo: " . $th->getFile() . " en la línea " . $th->getLine() . "</p>";
            die("Error al conectar a la base de datos. Estamos trabajando para solucionarlo. Intenta más tarde.");
        }
    }

    /**
     * Devuelve la conexión a la base de datos.
     *
     * Si todavía no existe, la crea con conectar(); si ya existe, reutiliza la misma.
     *
     * @return PDO Conexión a la base de datos
     */
    public static function getConexion(): PDO
    {
        if (self::$conexion === null) {
            self::conectar();
        }
        return self::$conexion;
    }
}