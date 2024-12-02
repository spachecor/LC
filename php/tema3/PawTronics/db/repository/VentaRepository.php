<?php

/**
 * Clase VentaRepository que desciende del Repository. Se encarga de gestionar el Repositorio de la Entidad Venta
 * @see Repository
 * @see Venta
 * @author Selene
 * @version 1.0
 */
class VentaRepository extends Repository
{
    protected string $table = "ventas";
    public function __construct()
    {
        parent::__construct($this->table);
    }
    protected function getEntityClass(): string
    {
        return Venta::class;
    }

    protected function mapRowToEntity(array $row): Entity
    {
        return Venta::fromArray($row);
    }
    //TODO sobreescribir todos los metodos que usen el id para que funcionen
}