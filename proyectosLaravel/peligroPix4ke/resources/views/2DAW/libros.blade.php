@extends('templates.plantilla')
@section('titulo')
    Mi app
@endsection
@section('contenido')
<ul>
        @foreach($lista_de_libros as $libro)
            <li>{{$libro->título}}</li>
        @endforeach
</ul>
@endsection