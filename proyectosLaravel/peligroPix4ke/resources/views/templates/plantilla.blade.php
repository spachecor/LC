<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo')</title>
</head>
<body>
    <nav>
        <ul>
            <li><a href="{{route('home')}}">Home</a></li>
            <li><a href="{{ route('modulo') }}">Módulo</a></li>
            <li><a href="{{route('profesor')}}">Profesor</a></li>
            <li><a href="{{route('libros')}}">Libros</a></li>
        </ul>
    </nav>
    @yield('contenido')
</body>
</html>