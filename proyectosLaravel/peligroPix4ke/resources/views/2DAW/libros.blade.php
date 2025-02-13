@extends('templates.plantilla')
@section('titulo')
    Mi app
@endsection
@section('contenido')
<ul>
        @foreach($lista_de_libros as $libro)
            <li><a href="{{route('libroEnlazado', $libro)}}">{{$libro->título}}</a></li>
        @endforeach
        {{$lista_de_libros->links()}}
</ul>
@endsection