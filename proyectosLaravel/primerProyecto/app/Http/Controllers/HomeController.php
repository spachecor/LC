<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke(){
        return "<h1>PIX4KE</h1><br>Bienvenido a Laravel!";
    }
}
