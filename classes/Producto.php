<?php

class Producto
{

    private int $id;
    private string $nombre;
    private string $imagen;
    private string $alt;
    private string $etiqueta;
    private string $tipoEtiqueta;
    private string $descripcion;
    private string $precio;


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
     * Get the value of etiqueta
     */
    public function getEtiqueta(): ?string
    {
        return $this->etiqueta;
    }

    /**
     * Get the value of tipoEtiqueta
     */
    public function getTipoEtiqueta(): ?string
    {
        return $this->tipoEtiqueta;
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

}
