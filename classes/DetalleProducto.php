<?php

class DetalleProducto
{

    private int $id;
    private string $nombre;
    private string $precio;
    private string $altura;
    private string $acabado;
    private bool $baseIncluida;
    private string $edicion;
    private array $imagenes;
    private array $pagos;


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
     * Get the value of precio
     */
    public function getPrecio(): string
    {
        return $this->precio;
    }

    /**
     * Get the value of altura
     */
    public function getAltura(): string
    {
        return $this->altura;
    }

    /**
     * Get the value of acabado
     */
    public function getAcabado(): string
    {
        return $this->acabado;
    }

    public function incluyeBase(): bool
    {
        return $this->baseIncluida;
    }

    /**
     * Get the value of edicion
     */
    public function getEdicion(): string
    {
        return $this->edicion;
    }

    /**
     * Get the value of imagenes
     */
    public function getImagenes(): array
    {
        return $this->imagenes;
    }

    /**
     * Get the value of pagos
     */
    public function getPagos(): array
    {
        return $this->pagos;
    }
}
