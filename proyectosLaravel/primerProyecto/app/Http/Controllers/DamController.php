<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DamController extends Controller
{
    function index(){
        return "Estás en 2º DAM, en Lenguajes de Contacto";
    }
    function profesor(){
        return "LENGUAJES DE CONTACTO Y YA";
    }
    function modulo($modulo){
        return "Hola crack, bienvenido al módulo: $modulo";
    }
    function notas($modulo, $alumno, $nota=null){
        return "Hola $alumno, bienvenido al módulo: $modulo. ".(($nota==null)?'Aún no han puesto tu nota.':"Tu nota es de: $nota");
    }
}