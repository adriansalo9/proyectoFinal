<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Smine</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <!-- Styles -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../resources/css/style.css">
    <script src="../resources/js/javaS1.js"></script>
    <script src="../resources/js/snake.js"></script>
    <script src="../resources/js/minesweeper.js"></script>
    <script>
        function guardarPuntuacion(score) {
            $.ajax({
                type: 'POST',
                data: {
                    'score': score,
                    /*"_token": "{{ csrf_token() }}"*/
                    "_token": $("meta[name='csrf-token']").attr("content")
                },
                /*dataType: 'script',*/
                url: '/laravelApp/proyectoFinal/public/snake',
                beforeSend: function() {
                    $('#resul').html('Procesando...');
                },
                success: function(data) {
                    console.log(data);
                    $('#resul').show();
                    $('#resul').html('Tu puntuación ha sido de: ' + score);
                }
            });
        }

        function guardarScore(mins, sgs, cnts) {
            $.ajax({
                type: 'post',
                data: {
                    'minutos': mins,
                    'segundos': sgs,
                    'centesimas': cnts
                },
                url: '../resources/views/ajax-time.blade.php',
                beforeSend: function() {
                    $('#resultado').html('Procesando...');
                },
                success: function(response) {
                    $('#resultado').html(mins + ':' + sgs + ':' + cnts);
                }
            });
        }
    </script>
    <style>
        body {
            font-family: 'Helvetica', sans-serif;
        }

        #contenido {
            margin-top: 8%;
        }

        @media only screen and (max-width: 550px) {
            #contenido {
                margin-top: 20%;
            }
        }
    </style>
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/home') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                        @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/') }}">Inicio<span class="sr-only">(current)</span></a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/snake') }}">Snake</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/mine') }}">Buscaminas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/score') }}">Puntuaciones</a>
                        </li>
                        @endauth
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Iniciar sesión') }}</a>
                        </li>
                        @endif

                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Registrarse') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ url('/user') }}">
                                    {{ __('Perfil') }}
                                </a>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Cerrar sesión') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>


                                <form id="logout-form" action="{{ url('/user') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4" id="contenido">
            @yield('content')
        </main>
    </div>
</body>

</html>