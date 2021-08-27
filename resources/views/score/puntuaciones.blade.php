@extends('layouts.app')
@section('content')
{{dd($user->name)}}
<!--<table class="table table-striped text-center">
    <h1 class="h2 text-center">Mis puntuaciones de Snake</h1>
    @foreach ($users as $user)
        @foreach ($user->snake as $puntos)
        <tr>
            <td>{{$user->name}} → <b>{{$puntos->score}}</b></td>
        </tr>
        @endforeach
    @endforeach 
</table>
<table class="table table-striped text-center">
    <h1 class="h2 text-center">Mis tiempos de Buscaminas</h1>
    @foreach ($users as $user)
        @foreach ($user->mine as $puntos)
        <tr>
            <td>{{$user->name}} → <b>{{$puntos->minutos}}:{{$puntos->segundos}}:{{$puntos->centesimas}}</b></td>
        </tr>
        @endforeach
    @endforeach 
</table>
<footer class="footer">
    <div class="contanier">
        <p><a class="menu-link" href="https://github.com/adriansalo9">Página diseñada por Adrián Saló</a></p>
    </div>
</footer>-->
@endsection