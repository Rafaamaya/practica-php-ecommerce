<?php

class Vista
{
    private int $id;
    private string $nombre;
    private string $titulo;
    private int $activa;
    private int $restringida;

    /**
     * Valida la vista pedida y devuelve la que corresponde mostrar.
     *
     * Busca la vista en la tabla vistas y devuelve:
     * - la misma vista, si existe, tiene su archivo, está activa y no está restringida;
     * - la vista 404, si no está en la tabla o falta su archivo;
     * - la vista 403, si está restringida;
     * - la vista 503, si no está activa.
     *
     * @param string $vista Nombre de la vista pedida (valor de content en la URL)
     * @param string $carpeta Carpeta de los archivos de vistas: 'views' (frontend) o 'admin/views' (panel)
     * @return Vista Vista a mostrar
     */
    public static function validarVista(string $vista, string $carpeta = 'views'): Vista
    {
        $conexion = Conexion::getConexion();
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

    /**
     * Devuelve el id de la vista.
     *
     * @return int El id de la vista
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Asigna el id de la vista.
     *
     * @param int $id El id de la vista
     * @return void
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * Devuelve el nombre de la vista (coincide con el nombre de su archivo).
     *
     * @return string El nombre de la vista (coincide con el nombre de su archivo)
     */
    public function getNombre(): string
    {
        return $this->nombre;
    }

    /**
     * Asigna el nombre de la vista.
     *
     * @param string $nombre El nombre de la vista
     * @return void
     */
    public function setNombre(string $nombre): void
    {
        $this->nombre = $nombre;
    }

    /**
     * Devuelve el título de la vista (se usa en la etiqueta title).
     *
     * @return string El título de la vista (se usa en la etiqueta title)
     */
    public function getTitulo(): string
    {
        return $this->titulo;
    }

    /**
     * Asigna el título de la vista.
     *
     * @param string $titulo El título de la vista
     * @return void
     */
    public function setTitulo(string $titulo): void
    {
        $this->titulo = $titulo;
    }

    /**
     * Devuelve si la vista está activa (1 = sí, 0 = no).
     *
     * @return int Si la vista está activa (1 = sí, 0 = no)
     */
    public function getActiva(): int
    {
        return $this->activa;
    }

    /**
     * Asigna si la vista está activa (1 = sí, 0 = no).
     *
     * @param int $activa Si la vista está activa (1 = sí, 0 = no)
     * @return void
     */
    public function setActiva(int $activa): void
    {
        $this->activa = $activa;
    }

    /**
     * Devuelve si la vista es solo para usuarios autorizados (1 = sí, 0 = no).
     *
     * @return int Si la vista es solo para usuarios autorizados (1 = sí, 0 = no)
     */
    public function getRestringida(): int
    {
        return $this->restringida;
    }

    /**
     * Asigna si la vista es solo para usuarios autorizados (1 = sí, 0 = no).
     *
     * @param int $restringida Si la vista es solo para usuarios autorizados (1 = sí, 0 = no)
     * @return void
     */
    public function setRestringida(int $restringida): void
    {
        $this->restringida = $restringida;
    }
}
