<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DamController extends Controller
{
    function index(){
        return view('2DAW.daw');
    }
    function profesor(){
        return view('2DAW.profesor');
    }
    function modulo($modulo){
        return view('2DAW.modulo', ['modulo'=>$modulo]);
    }
    function notas($modulo, $alumno, $nota=null){
        return view('2DAW.alumno', [
            'modulo'=>$modulo,
            'alumno'=>$alumno,
            'nota'=>$nota
            ]);
    }
}