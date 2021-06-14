@extends('layouts.app')
@section('content')
<table class="table table-striped text-center">
    <h1 class="h2 text-center">Mejores puntuaciones de Snake</h1>
    @foreach ($scoresSnake as $scoreSnake)
    <tr>
        <td>TOP {{$loop->index+1}} → <b>{{$scoreSnake->score }}</b></td>
    </tr>
    @endforeach 
</table>
<table class="table table-striped text-center">
    <h1 class="h2 text-center">Mejores tiempos de Buscaminas</h1>
    @foreach ($scoresMine as $scoreMine)
    <tr>
        <td>TOP {{$loop->index+1}} → <b>{{ $scoreMine->minutos}}:{{ $scoreMine->segundos}}:{{ $scoreMine->centesimas}}</b></td>
    </tr>
    @endforeach
</table>
<footer class="footer">
    <div class="contanier">
        <p><a class="menu-link" href="https://github.com/adriansalo9">Página diseñada por Adrián Saló</a></p>
    </div>
</footer>
@endsection