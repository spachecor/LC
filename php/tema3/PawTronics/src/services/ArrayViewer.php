<?php
namespace services;
class ArrayViewer{
    /**
     * Función que recibe un array y que devuelve este array convertido en una cadena separando los valores por comas
     * @param $array array El array a convertir
     * @return string La cadena convertida
     */
    public static function walker(array $array): string{
        return implode(', ', $array);
    }
}