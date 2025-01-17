<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DamController;

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

Route::get('/', HomeController::class)->name('home');
Route::get('DAM', [DamController::class, 'index'])->name('index');
Route::get('DAM/HLCProfesor', [DamController::class, 'profesor'])->name('profesor');
Route::get('DAM/{modulo?}', [DamController::class, 'modulo'])->name('modulo');
Route::get('DAM/{modulo}/{alumno}/{nota?}', [DamController::class, 'notas'])->name('notas');