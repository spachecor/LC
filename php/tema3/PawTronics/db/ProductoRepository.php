<?php
class ProductoRepository extends Repository{
    protected string $table = 'Productos';
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
}