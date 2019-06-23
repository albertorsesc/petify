<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>petify</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="{{ mix('css/main.css') }}">

</head>
<body class="bg-main">
<div id="app" class="justify-center flex items-center relative h-screen">
    @if (Route::has('login'))
        <div class="top-right links">
            @auth
                <a href="{{ url('/home') }}">Inicio</a>
                @else
                    <a href="{{ route('login') }}">Iniciar Sesion</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">Registrarme</a>
                    @endif
                    @endauth
        </div>
    @endif

    <div class="text-center">
        <img src="/logo-6.png" width="420px" height="330px">
        <div class="text-8xl mb-8 -mt-20">
            petify
        </div>
    </div>
</div>

<script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
