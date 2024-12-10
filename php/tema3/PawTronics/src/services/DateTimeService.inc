<?php

namespace services;
use DateMalformedStringException;
use DateTime;

/**
 * Clase DateTimeService que se encarga de ayudar en las conversiones de fecha-string y string-fecha
 * @author Selene
 * @version 1.0
 */
class DateTimeService
{
    /**
     * Función que convierte un objeto DateTime a un string
     * @param DateTime $dateTime El objeto DateTime que nos entra para convertir
     * @return string La fecha convertida en cadena
     */
    public static function toStringFromDateTime(DateTime $dateTime): string
    {
        return $dateTime->format('Y-m-d');
    }

    /**
     * Función que convierte una cadena a un objeto del tipo DateTime
     * @param string $dateTime La cadena a convertir en el objeto DateTime
     * @return DateTime  El objeto DateTime resultante
     * @throws DateMalformedStringException
     */
    public static function toDateTimeFromString(string $dateTime): DateTime
    {
        return new DateTime($dateTime);
    }
}