<?php

namespace models;
/**
 * Interfaz encargada de modelar el comportamiento de todas las entidades del programa
 * @author Selene
 * @version 1.0
 */
interface Entity
{
    /**
     * Función encargada de devolver el id de la entidad
     * @return mixed El id del al entidad. Puede ser string o int
     */
    public function getId(): mixed;

    /**
     * Función encargada de asignar el id de la entidad
     * @param $id mixed El id de la entidad. Puede ser string o int
     * @return void
     */
    public function setId($id): void;

    /**
     * Función que convierte una entidad en un array asociativo
     * @return array El array asociativo que representa la entidad
     */
    public function toArray(): array;

    /**
     * Función que convierte un array asociativo en una entidad
     * @param array $data El array asociativo
     * @return self La entidad
     */
    public static function fromArray(array $data): self;
}