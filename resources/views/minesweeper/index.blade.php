@extends('layouts.app')
@section('content')
<body id="snake">
    <div class="container-fluid" id="buscaminas">
        <div id="tablero">
            </div>
            <div id="estado">
                <div>Nº de minas restante: <span id="numMinasRestantes"></span>
            </div>
        </div>
        <div id="cronometro">
            <div id="reloj">
                00 00 00
            </div>
            <div id="resultado"></div>
        </div>
    </div>
    <footer class="footer">
        <div class="contanier">
            <p><a class="menu-link" href="https://github.com/adriansalo9">Página diseñada por Adrián Saló</a></p>
        </div>
    </footer>
</body>
@endsection