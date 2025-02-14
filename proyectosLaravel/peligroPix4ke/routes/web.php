<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DamController;
use App\Http\Controllers\LibrosController;

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
/*->name('nombre') es el nombre simbolico para ir a esa ruta desde uno de mis html*/
Route::get('/', HomeController::class)->name('home');
Route::get('DAM', [DamController::class, 'index'])->name('index');
Route::get('DAM/HLCProfesor', [DamController::class, 'profesor'])->name('profesor');
Route::get('DAM/libros', [LibrosController::class, 'index'])->name('libros');
Route::post('DAM/libros', [LibrosController::class, 'agregar'])->name('agregar');
Route::get("DAM/libros/crear", [LibrosController::class, 'crear'])->name('crear');
Route::get("DAM/libros/{libro}", [LibrosController::class, 'libroEnlazado'])->name('libroEnlazado');
Route::put('DAM/libros/{libro}',[LibrosController::class,'actualizar'])->name('actualizar');
Route::get("DAM/libros/{libro}/editar", [LibrosController::class, 'editar'])->name('editar');
Route::get('DAM/libros/libro/{titulo}', [LibrosController::class, 'libro'])->name('libro');
Route::get('DAM/{modulo?}', [DamController::class, 'modulo'])->name('modulo');
Route::get('DAM/{modulo}/{alumno}/{nota?}', [DamController::class, 'notas'])->name('notas');