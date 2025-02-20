@extends('templates.plantilla')
@section('titulo')
    Mi app
@endsection
@section('contenido')
<h1>{{$libro->título}}</h1>
<p>Autor: {{$libro->autor}}</p>
<p>Categoría: {{$libro->categoría}}</p>
<p>Número de páginas: {{$libro->num_páginas}}</p>
<p>Editorial: {{$libro->editorial}}</p>
<p>ISBN: {{$libro->isbn}}</p>
<p>Precio: {{$libro->pvp}}€</p>
<a href="{{route('editar', $libro)}}">Editar Libro</a>
<form action="{{route('eliminar', $libro)}}" method="POST">
    @method('delete')
    @csrf
    <button type="submit">Eliminar Libro</button>
</form>
@endsection