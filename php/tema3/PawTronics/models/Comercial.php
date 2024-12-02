<?php

/**
 * Clase Comercial, que modela como será la entidad Comercial y su comportamiento
 * @author Selene
 * @version 1.0
 */
class Comercial implements Entity
{
    private mixed $id;
    private string $nombre;
    private float $salario;
    private int $hijos;
    private DateTime $fNacimiento;

    public function __construct($codigo, $nombre, $salario, $hijos, $fNacimiento){
        $this->id = $codigo;
        $this->nombre = $nombre;
        $this->salario = $salario;
        $this->hijos = $hijos;
        // Convertir string a DateTime si es necesario(ternario)
        $this->fNacimiento = is_string($fNacimiento)
            ? DateTimeService::toDateTimeFromString($fNacimiento)
            : $fNacimiento;
    }
    public static function fromArray(array $data): Entity
    {
        return new self(
            $data['id'],
            $data['nombre'],
            $data['salario'],
            $data['hijos'],
            $data['fNacimiento']
        );
    }
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'salario' => $this->salario,
            'hijos' => $this->hijos,
            'fNacimiento' => $this->fNacimiento
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
    public function setNombre(string $nombre): void
    {
        $this->nombre = $nombre;
    }
    public function getSalario(): float
    {
        return $this->salario;
    }
    public function setSalario(float $salario): void
    {
        $this->salario = $salario;
    }
    public function getHijos(): int
    {
        return $this->hijos;
    }
    public function setHijos(int $hijos): void
    {
        $this->hijos = $hijos;
    }
    public function getFNacimiento(): DateTime
    {
        return $this->fNacimiento;
    }
    public function setFNacimiento(DateTime $fNacimiento): void
    {
        $this->fNacimiento = $fNacimiento;
    }
}