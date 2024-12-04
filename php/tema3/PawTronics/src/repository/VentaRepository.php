<?php

namespace repository;

use http\Exception\RuntimeException;
use models\Entity;
use models\Venta;
use PDO;
use PDOException;
use Services\ArrayViewer;
use services\Connection;
use services\DateTimeService;

require_once "src/services/Connection.php";
require_once "src/models/Entity.php";

/**
 * Clase VentaRepository que desciende del Repository. Se encarga de gestionar el Repositorio de la Entidad Venta.
 * Sobreescribe varios métodos del Repository porque Venta necesita varios retoques más que otras entidades.
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

    public function findAll(): array
    {
        try{
            $connectionObject = new Connection();
            $connection = $connectionObject->getConnection();
            $statement = $connection->query(
                "select c.codigo as comercial_id, c.nombre as comercial_nombre, c.salario as comercial_salario,
            c.hijos as comercial_hijos, c.fNacimiento as comercial_fNacimiento, p.referencia as producto_id, 
            p.nombre as producto_nombre, p.descripcion as producto_descripcion, p.precio as producto_precio, 
            p.descuento as producto_descuento, v.cantidad, v.fecha
            from comerciales c
            inner join $this->table v
            on c.codigo = v.codComercial
            inner join productos p
            on p.referencia = v.refProducto;"
            );
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            $entities = [];
            $entityClass = $this->getEntityClass();
            foreach ($results as $row) {
                $entities[] = $entityClass::fromArray($row);
            }
            $connectionObject->__destruct();
            return $entities;
        }catch (PDOException $e){
            throw new RuntimeException("Error en la búsqueda de todas las entidades de la tabla ".
                $this->table." por: ".$e->getMessage());
        }
    }

    public function findById(mixed $id): ?Entity
    {
        try{
            $connectionObject = new Connection();
            $connection = $connectionObject->getConnection();
            $query = "select c.codigo as comercial_id, c.nombre as comercial_nombre, c.salario as comercial_salario, 
                    c.hijos as comercial_hijos, c.fNacimiento as comercial_fNacimiento, p.referencia as producto_id, 
                    p.nombre as producto_nombre, p.descripcion as producto_descripcion, p.precio as producto_precio, 
                    p.descuento as producto_descuento, v.cantidad, v.fecha
                    from comerciales c 
                        inner join $this->table v 
                            on c.codigo = v.codComercial 
                        inner join productos p 
                            on p.referencia = v.refProducto 
                    where c.codigo = :codComercial and p.referencia = :refProducto and fecha = :fecha";
            $statement = $connection->prepare($query);
            $statement->bindParam(":codComercial", $id['codComercial']);
            $statement->bindParam(":refProducto", $id['refProducto']);
            $statement->bindParam(":fecha", $id['fecha']);
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            $connectionObject->__destruct();
            if ($result) return $this->mapRowToEntity($result);
            return null;
        }catch (PDOException $e){
            throw new RuntimeException("Error en la búsqueda de la entidad con id: ".ArrayViewer::walker($id)." de la tabla ".
                $this->table." por: ".$e->getMessage());
        }
    }

    public function insert(Entity $entity): void
    {
        try{
            $this->makeTransaction(function ($connection) use ($entity) {
                //creamos sql
                $query = "insert into $this->table (codComercial, refProducto, cantidad, fecha) 
                        values (:codComercial, :refProducto, :cantidad, :fecha)";
                //preparamos, asignamos valores y ejecutamos la consulta
                $statement = $connection->prepare($query);
                $statement->bindParam(":codComercial", $entity->getId()['codComercial']);
                $statement->bindParam(":refProducto", $entity->getId()['refProducto']);
                $cantidad = $entity->getCantidad();
                $statement->bindParam(":cantidad", $cantidad);
                $fecha = DateTimeService::toStringFromDateTime($entity->getFecha());
                $statement->bindParam(":fecha", $fecha);
                //ejecutamos la query preparada
                $statement->execute();
            });
        }catch(PDOException $e){
            throw new RuntimeException("Error en la inserción de la entidad con id: ".ArrayViewer::walker($entity->getId())." de la tabla ".
                $this->table." por: ".$e->getMessage());
        }
    }

    function update(mixed $id, Entity $entity): void
    {
        try{
            $this->makeTransaction(function ($connection) use ($id, $entity) {
                //convertimos el objeto entrante en array
                $data = $entity->toArray();
                //creamos la query
                $query = "update $this->table 
                        set codComercial = :codComercial, refProducto = :refProducto, cantidad = :cantidad, fecha = :fecha 
                        where codComercial = :codComercialPK and refProducto = :refProductoPK and fecha = :fechaPK";
                $statement = $connection->prepare($query);
                $statement->bindParam(":codComercial", $data['comercial']['codigo']);
                $statement->bindParam(":refProducto", $data['producto']['referencia']);
                $statement->bindParam(":cantidad", $data['cantidad']);
                $statement->bindParam(":fecha", $data['fecha']);
                $statement->bindValue(":codComercialPK", $id['codComercial']);
                $statement->bindValue(":refProductoPK", $id['refProducto']);
                $statement->bindValue(":fechaPK", $id['fecha']);
                $statement->execute();
            });
        }catch (PDOException $e){
            throw new RuntimeException("Error en la modificación de la entidad con id: ".ArrayViewer::walker($id)." de la tabla ".
                $this->table." por: ".$e->getMessage());
        }
    }

    function delete(mixed $id): void
    {
        try{
            $this->makeTransaction(function ($connection) use ($id) {
                $query = "delete from $this->table 
                        where codComercial = :codComercial and refProducto = :refProducto and fecha = :fecha";
                $statement = $connection->prepare($query);
                $statement->bindValue(":codComercial", $id['codComercial']);
                $statement->bindValue(":refProducto", $id['refProducto']);
                $statement->bindValue(":fecha", $id['fecha']);
                $statement->execute();
            });
        }catch (PDOException $e){
            throw new RuntimeException("Error en la eliminación de la entidad con id: ".ArrayViewer::walker($id)." de la tabla ".
                $this->table." por: ".$e->getMessage());
        }
    }

    protected function getIdColumnName(): string
    {
        throw new RuntimeException("No implementado.");
    }
}