<?php
class Producto {
    private $referencia;
    private $nombre;
    private $descripcion;
    private $precio;
    private $descuento;

    public function __construct($referencia, $nombre, $descripcion, $precio, $descuento) {
        $this->referencia = $referencia;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->precio = $precio;
        $this->descuento = $descuento;
    }
    public function getReferencia() {
        return $this->referencia;
    }
    public function setReferencia($referencia) {
        $this->referencia = $referencia;
    }
    public function getNombre() {
        return $this->nombre;
    }
    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }
    public function getDescripcion() {
        return $this->descripcion;
    }
    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }
    public function getPrecio() {
        return $this->precio;
    }
    public function setPrecio($precio) {
        $this->precio = $precio;
    }
    public function getDescuento() {
        return $this->descuento;
    }
    public function setDescuento($descuento) {
        $this->descuento = $descuento;
    }
}