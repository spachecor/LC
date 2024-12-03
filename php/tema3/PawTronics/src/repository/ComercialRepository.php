<?php

namespace repository;

use models\Comercial;
use models\Entity;

/**
 * Clase ComercialRepository que desciende del Repository. Se encarga de gestionar el Repositorio de la Entidad Comercial
 * @see Repository
 * @see Comercial
 * @author Selene
 * @version 1.0
 */
class ComercialRepository extends Repository
{
    protected string $table = "comerciales";

    public function __construct()
    {
        parent::__construct($this->table);
    }

    protected function getEntityClass(): string
    {
        return Comercial::class;
    }

    protected function mapRowToEntity(array $row): Entity
    {
        return Comercial::fromArray($row);
    }
}