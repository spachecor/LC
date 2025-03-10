<?php

namespace repository;

use models\Entity;
use models\Producto;

/**
 * Clase ProductoRepository que desciende del Repository. Se encarga de gestionar el Repositorio de la Entidad Producto
 * @see Repository
 * @see Producto
 * @author Selene
 * @version 1.0
 */
class ProductoRepository extends Repository
{
    protected string $table = 'productos';
    protected string $idColumnName = 'referencia';

    public function __construct()
    {
        parent::__construct($this->table);
    }

    protected function getEntityClass(): string
    {
        return Producto::class;
    }

    protected function mapRowToEntity(array $row): Entity
    {
        return Producto::fromArray($row);
    }

    protected function getIdColumnName(): string
    {
        return $this->idColumnName;
    }
}