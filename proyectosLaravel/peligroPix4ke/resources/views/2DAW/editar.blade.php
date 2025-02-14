@extends('templates.plantilla')
@section('titulo')
    Mi app
@endsection
@section('contenido')
<h1>Editar Libro</h1>

<form action="{{route('actualizar', $libro)}}" method="POST">
    @csrf
    @method('put')

    <label>Título</label><br>
    <input type="text" name="titulo" value="{{$libro->título}}"><br>
    <label>isbn (números)</label><br>
    <input type="number" name="isbn" value="{{$libro->isbn}}" min="0" max="99999999"> <br>
    <label>autor</label><br>
    <input type="text" name="autor" value="{{$libro->autor}}"><br>
    <label>editorial</label><br>
    <input type="text" name="editorial" value="{{$libro->editorial}}"> <br>
    <label>Número de páginas (números)</label><br>
    <input type="number" name="npaginas" value="{{$libro->num_páginas}}" min="0" max="999"> <br>
    <label>pvp (números)</label><br>
    <input type="number" name="pvp" value="{{$libro->pvp}}" min="0" max="999"> <br>
    <label>Categoría</label><br>
    <select name="categoria" value="{{$libro->categoría}}">
            <option value="Ciencia Ficción">Ciencia Ficción</option>
            <option value="Novela">Novela</option>
            <option value="Biografia">Biografía</option>
            <option value="Desarollo Personal">Desarollo Personal</option>
    </select>
    <br><br>
    <button type="submit">Editar Libro</button>
</form>
@endsection