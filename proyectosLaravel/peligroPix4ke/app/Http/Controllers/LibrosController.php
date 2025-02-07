<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Libro;

class LibrosController extends Controller
{
    public function index(){
        $libros = Libro::all();
        return view('2DAW.libros', ['lista_de_libros'=>$libros]);
    }
}
