@extends('templates.plantilla')
@section('titulo')
    Mi app
@endsection
@section('contenido')
<h1>Crear Libro</h1>
    <form action="{{route('agregar')}}" method="POST">
        @csrf
        <label>Título</label><br>
        <input type="text" name="titulo" required><br>
        <label>isbn (números)</label><br>
        <input type="text" name="isbn" pattern="[0-9]+" maxlength=9 required> <br>
        <label>autor</label><br>
        <input type="text" name="autor" required><br>
        <label>editorial</label><br>
        <input type="text" name="editorial" required> <br>
        <label>Número de páginas (números)</label><br>
        <input type="text" name="npaginas" pattern="[0-9]+" maxlength=9> required <br>
        <label>pvp (números)</label><br>
        <input type="text" name="pvp" pattern="[0-9]+" maxlength=9 required> <br>
        <label>Categoría</label><br>
        <select name="categoria" required>
            <option value="Ciencia Ficción">Ciencia Ficción</option>
            <option value="Novela">Novela</option>
            <option value="Biografia">Biografía</option>
            <option value="Desarollo Personal">Desarollo Personal</option>
        </select>
        <br><br>
        @auth
        <button type="submit">Agregar Libro</button>
        @else
        <p>Para enviar el formulario, registrate <a href="{{route('login')}}"><b>PUTO</b></a></p>
        @endauth
    </form>
@endsection