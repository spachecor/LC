@extends('templates.plantilla')
@section('titulo')
    Mi app
@endsection
@section('contenido')
<p>Hola crack, bienvenido al módulo: <?php echo $modulo; ?></p>
<h1>
    @if($modulo) 
        Módulo: {{ $modulo }} 
    @else 
        No se especificó un módulo 
    @endif 
</h1>
@endsection