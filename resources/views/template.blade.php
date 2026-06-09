<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<header class="header">
    <div class="header-inner">
        <div class="logo">Eventos</div>
        <nav class="nav">
            <a href="{{ route('home') }}" class="nav-link">Home</a>
            <a href="{{ route('eventos') }}" class="nav-link">Eventos</a>
        </nav>
    </div>
</header>

<main class="main-content">
    @yield('conteudo')
</main>

<footer class="footer">
    <p>&copy; {{ date('Y') }} Eventos</p>
</footer>

</body>
</html>
