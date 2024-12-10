<?php
namespace services;
/**
 * Clase auxiliar que contiene una función para ayudar a la legibilidad de un array
 * @author Selene
 * @version 1.0
 */
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