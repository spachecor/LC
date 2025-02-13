@extends('templates.plantilla')
@section('titulo')
    Mi app
@endsection
@section('contenido')
<ul>
    <li>
        @if($libro==null||$libro['título']=="")
        Libro no encontrado
        @else
            {{$libro->título}}
        @endif    
    </li>
</ul>
@endsection