<?php
interface Entity {
    public function getId();
    public function setId($id): void;
    //Convierte la entidad en un array asociativo
    public function toArray(): array;
    //asigna los valores desde un array
    public static function fromArray(array $data): self;
}