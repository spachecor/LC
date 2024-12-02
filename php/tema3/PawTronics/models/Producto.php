<?php

/**
 * Clase Producto, que modela como será la entidad Producto y su comportamiento
 * @author Selene
 * @version 1.0
 */
class Producto implements Entity
{
    private mixed $id;
    private string $nombre;
    private string $descripcion;
    private float $precio;
    private int $descuento;

    public function __construct($id, $nombre, $descripcion, $precio, $descuento)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->precio = $precio;
        $this->descuento = $descuento;
    }
    public static function fromArray(array $data): self
    {
        return new self
        (
            $data['id'],
            $data['nombre'],
            $data['descripcion'],
            (float) $data['precio'],
            (int) $data['descuento']
        );
    }
    public function toArray(): array
    {
        return
            [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'precio' => $this->precio,
            'descuento' => $this->descuento
        ];
    }
    public function getId(): mixed
    {
        return $this->id;
    }
    public function setId(mixed $id): void
    {
        $this->id = $id;
    }
    public function getNombre(): string
    {
        return $this->nombre;
    }
    public function setNombre($nombre): void
    {
        $this->nombre = $nombre;
    }
    public function getDescripcion(): string
    {
        return $this->descripcion;
    }
    public function setDescripcion($descripcion): void
    {
        $this->descripcion = $descripcion;
    }
    public function getPrecio(): float
    {
        return $this->precio;
    }
    public function setPrecio($precio): void
    {
        $this->precio = $precio;
    }
    public function getDescuento(): int
    {
        return $this->descuento;
    }
    public function setDescuento($descuento): void
    {
        $this->descuento = $descuento;
    }
}