<?php
require_once __DIR__ . "/Conexion.php";

class Vista
{
    private int $id;
    private string $nombre;
    private string $titulo;
    private int $activa;
    private int $restringida;

    /**
     * Valida si la vista solicitada existe y está activa, y devuelve un objeto Vista con sus datos.
     * @param string $vista Nombre de la vista solicitada
     * @param string $carpeta Carpeta donde se encuentran los archivos de vistas (por defecto 'views')
     * @return Vista Objeto Vista con los datos de la vista solicitada o una vista por defecto si no existe o no está activa
     */
    public static function validarVista(string $vista, string $carpeta = 'views'): Vista
    {
        $conexion = (new Conexion())->getConexion();
        $query = "SELECT * FROM vistas
                  WHERE nombre = :nombre";
        try {
            $PDOStatement = $conexion->prepare($query);
            $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
            $PDOStatement->execute(['nombre' => $vista]);
            $vistaObtenida = $PDOStatement->fetch();

        } catch (PDOException $e) {
            echo "<p>Se generó un error en el siguiente archivo: " . $e->getFile() . " en la línea " . $e->getLine() . "</p>";
            die("Error al validar la vista. Intenta más tarde.");
        }
        if ($vistaObtenida) {
            // La vista existe en la base pero falta su archivo: se trata como no encontrada
            if (!file_exists(__DIR__ . "/../" . $carpeta . "/" . $vistaObtenida->getNombre() . ".php")) {
                $vistaObtenida = new Vista();
                $vistaObtenida->nombre = '404';
                $vistaObtenida->titulo = 'Página no encontrada';
                $resultado = $vistaObtenida;
            } elseif ($vistaObtenida->getActiva()) {

                if (!$vistaObtenida->getRestringida()) {
                    $resultado = $vistaObtenida;
                } else {
                    // Si la vista está restringida, se puede devolver una vista de acceso denegado o lanzar una excepción
                    $vistaObtenida = new Vista();
                    $vistaObtenida->nombre = '403';
                    $vistaObtenida->titulo = 'Acceso denegado';
                    $resultado = $vistaObtenida;
                }
            } else {
                // Si la vista no está activa, se puede devolver una vista de mantenimiento o lanzar una excepción
                $vistaObtenida = new Vista();
                $vistaObtenida->nombre = '503';
                $vistaObtenida->titulo = 'Servicio no disponible';
                $resultado = $vistaObtenida;
            }
        } else {
            // Si no se encuentra la vista, se puede devolver una vista por defecto o lanzar una excepción
            $vistaObtenida = new Vista();
            $vistaObtenida->nombre = '404';
            $vistaObtenida->titulo = 'Página no encontrada';
            $resultado = $vistaObtenida;
        }
        return $resultado;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): void
    {
        $this->nombre = $nombre;
    }

    public function getTitulo(): string
    {
        return $this->titulo;
    }

    public function setTitulo(string $titulo): void
    {
        $this->titulo = $titulo;
    }

    public function getActiva(): int
    {
        return $this->activa;
    }

    public function setActiva(int $activa): void
    {
        $this->activa = $activa;
    }

    public function getRestringida(): int
    {
        return $this->restringida;
    }

    public function setRestringida(int $restringida): void
    {
        $this->restringida = $restringida;
    }
}
