<?php

/**
 * Clase Venta, que modela como será la entidad Venta y su comportamiento
 * @author Selene
 * @version 1.0
 */
class Venta implements Entity
{
    private mixed $id;
    private Comercial $comercial;
    private Producto $producto;
    private int $cantidad;
    private DateTime $fecha;
    public function __construct(Comercial $comercial, Producto $producto, int $cantidad, DateTime $fecha)
    {
        $this->id = [$comercial->getId(), $producto->getId(), DateTimeService::toDateTimeFromString($fecha)];
        $this->comercial = $comercial;
        $this->producto = $producto;
        $this->cantidad = $cantidad;
        $this->fecha = $fecha;
    }

    public function getId(): mixed
    {
        return $this->id;
    }

    public function setId(mixed $id): void
    {
        $this->id = $id;
    }

    public static function fromArray(array $data): Entity
    {
        return new self(
            new Comercial(
                $data['comercial']['id'],
                $data['comercial']['nombre'],
                $data['comercial']['salario'],
                $data['comercial']['hijos'],
                $data['comercial']['fNacimiento']
            ),
            new Producto(
                $data['producto']['id'],
                $data['producto']['nombre'],
                $data['producto']['descripcion'],
                $data['producto']['precio'],
                $data['producto']['descuento']
            ),
            $data['cantidad'],
            new DateTime($data['fecha'])
        );
    }
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'comercial' => $this->comercial->toArray(),
            'producto' => $this->producto->toArray(),
            'cantidad' => $this->cantidad,
            'fecha' => $this->fecha
        ];
    }

    public function getFecha(): DateTime
    {
        return $this->fecha;
    }

    public function setFecha(DateTime $fecha): void
    {
        $this->fecha = $fecha;
    }

    public function getCantidad(): int
    {
        return $this->cantidad;
    }

    public function setCantidad(int $cantidad): void
    {
        $this->cantidad = $cantidad;
    }

    public function getProducto(): Producto
    {
        return $this->producto;
    }

    public function setProducto(Producto $producto): void
    {
        $this->producto = $producto;
    }

    public function getComercial(): Comercial
    {
        return $this->comercial;
    }

    public function setComercial(Comercial $comercial): void
    {
        $this->comercial = $comercial;
    }
}