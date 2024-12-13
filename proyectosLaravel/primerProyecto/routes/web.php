<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('DAM', function(){
    return "Estás en 2º DAM, en Lenguajes de Contacto";
});
Route::get('DAM/HLCProfesor', function(){
    return "LENGUAJES DE CONTACTO Y YA";
});
Route::get('DAM/{modulo}', function($modulo){
    return "Hola crack, bienvenido al módulo: $modulo";
});
Route::get('DAM/{modulo}/{alumno}/{nota?}', function($modulo, $alumno, $nota=null){
    return "Hola $alumno, bienvenido al módulo: $modulo. ".(($nota==null)?'Aún no han puesto tu nota.':"Tu nota es de: $nota");
});