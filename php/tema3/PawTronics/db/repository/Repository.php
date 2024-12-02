<?php
require_once "db/Connection.php";

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
     * Función que realiza una transacción en la base de datos. Una vez se invoque, deberá de pasársele la función
     * que realizará dentro de la transacción ($function)
     * @param callable $function La función que realizará dentro de la transacción (insert, update, delete...)
     * @return bool Devuelve true si la transacción se realizó con éxito o false si no se realizó con éxito
     */
    function makeTransaction(callable $function): bool
    {
        $connectionObject = new Connection();
        $connection = $connectionObject->getConnection();
        $exito = false;
        try
        {
            $connection->setAttribute(PDO::ATTR_AUTOCOMMIT, false);
            $connection->beginTransaction();
            $function($connection);
            $connection->commit();
            $exito = true;
        }catch (PDOException $e)
        {
            $connection->rollBack();
        }finally
        {
            $connection->setAttribute(PDO::ATTR_AUTOCOMMIT, true);
            //finalizamos la conexión
            $connectionObject->__destruct();
            return $exito;
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
        $statement = $connection->query("SELECT * FROM $this->tableName");
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        $entities = [];
        $entityClass = $this->getEntityClass();
        foreach ($results as $row)
        {
            foreach ($row as $key => $value){
                echo $key.": ".$value."<br>";
                //TODO AQUI ESTA EL FALLO A LA HORA DE CONVERTIR LAS VENTAS EN OBJETOS VENTA, REVISAR
            }
            $entities[] = $entityClass::fromArray($row);
        }
        $connectionObject->__destruct();
        return $entities;
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
        $query = "SELECT * FROM $this->tableName WHERE id = :id";
        $statement = $connection->prepare($query);
        $statement->bindParam(":id", $id);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        $connectionObject->__destruct();
        if($result) return $this->mapRowToEntity($result);
        return null;
    }

    /**
     * Función que realiza la inserción de una entidad en la tabla de la Entidad
     * @param Entity $entity La Entidad a insertar
     * @return bool Devuelve true si se ha insertado correctamente y false si no se ha insertado correctamente
     */
    public function insert(Entity $entity): bool
    {
        return $this->makeTransaction(function($connection) use ($entity)
        {
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
            foreach ($data as $column => $value)
            {
                $statement->bindValue(":$column", $value);
            }
            //ejecutamos la query preparada
            $statement->execute();
        });
    }

    /**
     * Función que realiza una actualización de la Entidad que se le pasa en la tabla de la Entidad
     * @param Entity $entity La entidad a modificar
     * @return bool Devuelve true si la modificación se realizó con éxito y false si no se realizó con éxito
     */
    function update(Entity $entity): bool
    {
        return $this->makeTransaction(function($connection) use ($entity)
        {
            //convertimos el objeto entrante en array
            $data = $entity->toArray();
            //construimos la asignación de los nuevos valores
            $newValues = implode(", ", array_map(fn($col) => "$col = :$col", array_keys($data)));
            //creamos la query
            $query = "UPDATE $this->tableName SET $newValues WHERE id = :id";
            $statement = $connection->prepare($query);
            foreach ($data as $column => $value)
            {
                $statement->bindValue(":$column", $value);
            }
            $statement->bindValue(":id", $entity->getId());
            $statement->execute();
        });
    }

    /**
     * Función que elimina la Entidad correspondiente al id pasado como argumento a la función en la tabla de la
     * Entidad
     * @param $id mixed El id de la Entidad a eliminar
     * @return bool Devuelve true si se ha eliminado la Entidad correctamente y false si no se ha eliminado correctamente
     */
    function delete($id): bool
    {
        return $this->makeTransaction(function($connection) use ($id)
        {
            $query = "DELETE FROM $this->tableName WHERE id = :id";
            $statement = $connection->prepare($query);
            $statement->bindValue(":id", $id);
            $statement->execute();
        });
    }
}