<?php

namespace models;

use DateTime;
use services\DateTimeService;

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
        $this->id = [
            "codComercial" => $comercial->getId(),
            "refProducto" => $producto->getId(),
            "fecha" => DateTimeService::toStringFromDateTime($fecha)
        ];
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

    public static function fromArray(array $data): self
    {
        return new self(
            new Comercial(
                $data['comercial_id'],
                $data['comercial_nombre'],
                $data['comercial_salario'],
                $data['comercial_hijos'],
                $data['comercial_fNacimiento']
            ),
            new Producto(
                $data['producto_id'],
                $data['producto_nombre'],
                $data['producto_descripcion'],
                $data['producto_precio'],
                $data['producto_descuento']
            ),
            $data['cantidad'],
            DateTimeService::toDateTimeFromString($data['fecha'])
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'comercial' => $this->comercial->toArray(),
            'producto' => $this->producto->toArray(),
            'cantidad' => $this->cantidad,
            'fecha' => DateTimeService::toStringFromDateTime($this->fecha)
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