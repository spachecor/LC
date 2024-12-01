<?php
require_once "Connection.php";
abstract class Repository {
    protected string $tableName;
    function __construct(string $tableName) {
        $this->tableName = $tableName;
    }
    abstract protected function getEntityClass(): string;
    abstract protected function mapRowToEntity(array $row): Entity;
    function makeTransaction(callable $function): bool
    {
        $connectionObject = new Connection();
        $connection = $connectionObject->getConnection();
        $exito = false;
        try{
            $connection->setAttribute(PDO::ATTR_AUTOCOMMIT, false);
            $connection->beginTransaction();
            $function($connection);
            $connection->commit();
            $exito = true;
        }catch (PDOException $e){
            $connection->rollBack();
        }finally{
            $connection->setAttribute(PDO::ATTR_AUTOCOMMIT, true);
            //finalizamos la conexión
            $connectionObject->__destruct();
            return $exito;
        }
    }
    public function findAll(): array{
        $connectionObject = new Connection();
        $connection = $connectionObject->getConnection();
        $statement = $connection->query("SELECT * FROM $this->tableName");
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        $entities = [];
        $entityClass = $this->getEntityClass();
        foreach ($results as $row){
            $entities[] = $entityClass::fromArray($row);
        }
        $connectionObject->__destruct();
        return $entities;
    }
    public function findById($id): ?Entity{
        $connectionObject = new Connection();
        $connection = $connectionObject->getConnection();
        $query = "SELECT * FROM $this->tableName WHERE id = :id";
        $statement = $connection->prepare($query);
        $statement->bindParam(":id", $id);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        $connectionObject->__destruct();
        if($result) return $this->mapRowToEntity($result);
        return null;
    }
    public function insert(Entity $entity): bool{
        return $this->makeTransaction(function($connection) use ($entity){
            //convertimos la entidad en un array asociativo
            $data = $entity->toArray();
            //convertimos las columnas y los valores en cadenas sepradas por comas (valor, valor, etc.)
            $columns = implode(', ', array_keys($data));
            //usamos una función flecha para asignar : delante de cada valor
            $values = implode(", ", array_map(fn($col) => ":$col", array_keys($data)));
            //creamos sql
            $query = "INSERT INTO $this->tableName ($columns) VALUES ($values)";
            //preparamos, asignamos valores y ejecutamos la consulta
            $statement = $connection->prepare($query);
            foreach ($data as $column => $value) {
                $statement->bindValue(":$column", $value);
            }
            //ejecutamos la query preparada
            $statement->execute();
        });
    }
    function update(Entity $entity): bool{
        return $this->makeTransaction(function($connection) use ($entity){
            //convertimos el objeto entrante en array
            $data = $entity->toArray();
            //construimos la asignación de los nuevos valores
            $newValues = implode(", ", array_map(fn($col) => "$col = :$col", array_keys($data)));
            //creamos la query
            $query = "UPDATE $this->tableName SET $newValues WHERE id = :id";
            $statement = $connection->prepare($query);
            foreach ($data as $column => $value) {
                $statement->bindValue(":$column", $value);
            }
            $statement->bindValue(":id", $entity->getId());
            $statement->execute();
        });
    }
    function delete($id): bool{
        return $this->makeTransaction(function($connection) use ($id){
            $query = "DELETE FROM $this->tableName WHERE id = :id";
            $statement = $connection->prepare($query);
            $statement->bindValue(":id", $id);
            $statement->execute();
        });
    }
}