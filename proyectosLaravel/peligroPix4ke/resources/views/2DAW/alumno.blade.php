@extends('templates.plantilla')
@section('titulo')
    Mi app
@endsection
@section('contenido')
Hola <?php echo $alumno?>, bienvenido al módulo: <?php echo $modulo?>. <?php ($nota==null)?'Aún no han puesto tu nota.':"Tu nota es de: $nota"?>
@endsection