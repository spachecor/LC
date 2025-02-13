<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Libro;

class LibrosController extends Controller
{
    public function index(){
        $libros = Libro::paginate();
        return view('2DAW.libros', ['lista_de_libros'=>$libros]);
    }
    public function libro(String $titulo){
        $libros = Libro::all();
        $libro = null;
        for($i = 0;$i<$libros->count(); $i++){
            if($titulo==$libros[$i]['título'])$libro=$libros[$i];
            else $libro=['título'=>""];
        }
        return view('2DAW.libro', ['libro'=>$libro]);
    }
    public function libroEnlazado(Libro $libro){
        return view('2DAW.libro-enlazado', ['libro' => $libro]);
    }
}
