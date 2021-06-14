@extends('layouts.app')
@section('content')
<body id="snake">
<canvas width="400" height="400" onclick="startGame()"></canvas>
    <h1 class="h1-snake">HAZ CLICK PARA EMPEZAR A JUGAR</h1>
    <!-- <div class="container-snake">
        <canvas id="comenzarJuego" onclick="startGame()"></canvas>
        <h1 class="h1-snake">HAZ CLICK PARA EMPEZAR A JUGAR
            <p class="p-snake">
                Puedes mover la serpiente con las teclas W A S D
            </p>
            <img class="img-tecla" src="../img/tecla.png" alt="teclas para jugar al snake">
        </h1>
    </div>-->
    <div id="resul"></div>
    <footer class="footer">
        <div class="contanier">
            <p><a class="menu-link" href="https://github.com/adriansalo9">Página diseñada por Adrián Saló</a></p>
        </div>
    </footer>
</body>

@endsection