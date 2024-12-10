<?php

namespace repository;

use \RuntimeException;
use models\Entity;
use PDO;
use PDOException;
use services\Connection;

require_once "src/services/Connection.inc";

/**
 * Clase abstracta Repository, que maneja el CRUD de las entidades con la base de datos
 * @see Entity
 * @author Selene
 * @version 1.0
 */
abstract class Repository
{
    protected string $tableName;

    function __construct(string $tableName)
    {
        $this->tableName = $tableName;
    }

    /**
     * Función que devuelve la clase del repositorio que gestiona el CRUD de la entidad(ej: si es ProductoRepository, la
     * entityClass es Producto)
     * @return string La clase del repositorio que gestiona el CRUD de la entidad
     */
    abstract protected function getEntityClass(): string;

    /**
     * Función que convierte un array asociativo en una entidad
     * @param array $row El array asociativo que contiene los valores de la entidad
     * @return Entity La entidad ya creada
     */
    abstract protected function mapRowToEntity(array $row): Entity;

    /**
     * Función que devuelve el nombre de la columna de la primary key
     * @return string El nombre de la columna que contiene el id, que es la PK
     */
    abstract protected function getIdColumnName(): string;

    /**
     * Función que realiza una transacción en la base de datos. Una vez se invoque, deberá de pasársele la función
     * que realizará dentro de la transacción ($function)
     * @param callable $function La función que realizará dentro de la transacción (insert, update, delete...)
     */
    function makeTransaction(callable $function): void
    {
        $connectionObject = new Connection();
        $connection = $connectionObject->getConnection();
        try {
            $connection->setAttribute(PDO::ATTR_AUTOCOMMIT, false);
            $connection->beginTransaction();
            $function($connection);
            $connection->commit();
        } catch (PDOException $e) {
            $connection->rollBack();
            throw new RuntimeException("La transacción ha fallado por: ".$e->getMessage());
        } finally {
            $connection->setAttribute(PDO::ATTR_AUTOCOMMIT, true);
            //finalizamos la conexión
            $connectionObject->__destruct();
        }
    }

    /**
     * Función que devuelve un array con todas las entidades contenidas en la tabla de la Entidad
     * @return array El array de todas las entidades que contiene la tabla de la Entidad
     */
    public function findAll(): array
    {
        $connectionObject = new Connection();
        $connection = $connectionObject->getConnection();
        try{
            $statement = $connection->query("select * from $this->tableName");
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            $entities = [];
            $entityClass = $this->getEntityClass();
            foreach ($results as $row) {
                $entities[] = $entityClass::fromArray($row);
            }
            return $entities;
        }catch (PDOException $e){
            throw new RuntimeException("Error en la consulta de todas las entidades de la tabla ".
                $this->tableName." por: ".$e->getMessage());
        }finally{
            $connectionObject->__destruct();
        }
    }

    /**
     * Función que busca y encuentra una Entidad por el id en la tabla de la Entidad
     * @param $id mixed El id de la Entidad a buscar
     * @return Entity|null La Entidad en caso de encontrarla o null en caso de no encontrarla
     */
    public function findById(mixed $id): ?Entity
    {
        $connectionObject = new Connection();
        $connection = $connectionObject->getConnection();
        try{
            $query = "select * from $this->tableName where ".$this->getIdColumnName()." = :id";
            $statement = $connection->prepare($query);
            $statement->bindParam(":id", $id);
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            if ($result) return $this->mapRowToEntity($result);
            return null;
        }catch (PDOException $e){
            throw new RuntimeException("Error en la consulta de la entidad con id: ".$id." de la tabla ".
                $this->tableName." por: ".$e->getMessage());
        }finally{
            $connectionObject->__destruct();
        }
    }

    /**
     * Función que realiza la inserción de una entidad en la tabla de la Entidad
     * @param Entity $entity La Entidad a insertar
     */
    public function insert(Entity $entity): void
    {
        try{
            $this->makeTransaction(function ($connection) use ($entity) {
                //convertimos la entidad en un array asociativo
                $data = $entity->toArray();
                //convertimos las columnas y los valores en cadenas sepradas por comas (valor, valor, etc.)
                $columns = implode(', ', array_keys($data));
                //usamos una función flecha para asignar : delante de cada valor
                $values = implode(", ", array_map(fn($col) => ":$col", array_keys($data)));
                //creamos sql
                $query = "insert into $this->tableName ($columns) values ($values)";
                //preparamos, asignamos valores y ejecutamos la consulta
                $statement = $connection->prepare($query);
                foreach ($data as $column => $value) {
                    $statement->bindValue(":$column", $value);
                }
                //ejecutamos la query preparada
                $statement->execute();
            });
        }catch (PDOException $e){
            throw new RuntimeException("Error en la inserción de la entidad con id: ".$entity->getId()." de la tabla ".
                $this->tableName." por: ".$e->getMessage());
        }
    }

    /**
     * Función que realiza una actualización de la Entidad que se le pasa en la tabla de la Entidad
     * @param Entity $entity La entidad a modificar
     */
    function update(mixed $id, Entity $entity): void
    {
        try{
            $this->makeTransaction(function ($connection) use ($id, $entity) {
                //convertimos el objeto entrante en array
                $data = $entity->toArray();
                //construimos la asignación de los nuevos valores
                $newValues = implode(", ", array_map(fn($col) => "$col = :$col", array_keys($data)));
                //creamos la query
                $query = "update $this->tableName set $newValues where ".$this->getIdColumnName()." = :id";
                $statement = $connection->prepare($query);
                foreach ($data as $column => $value) {
                    $statement->bindValue(":$column", $value);
                }
                $statement->bindValue(":id", $id);
                $statement->execute();
            });
        }catch (PDOException $e){
            throw new RuntimeException("Error en la modificación de la entidad con id: ".$entity->getId()." de la tabla ".
                $this->tableName." por: ".$e->getMessage());
        }
    }

    /**
     * Función que elimina la Entidad correspondiente al id pasado como argumento a la función en la tabla de la
     * Entidad
     * @param $id mixed El id de la Entidad a eliminar
     */
    function delete(mixed $id): void
    {
        try{
            $this->makeTransaction(function ($connection) use ($id) {
                $query = "delete from $this->tableName where ".$this->getIdColumnName()." = :id";
                $statement = $connection->prepare($query);
                $statement->bindValue(":id", $id);
                $statement->execute();
            });
        }catch (PDOException $e){
            throw new RuntimeException("Error en la eliminación de la entidad con id: ".$id." de la tabla ".
                $this->tableName." por: ".$e->getMessage());
        }
    }
}