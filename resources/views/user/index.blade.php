@extends('layouts.app')

@section('content')
@if (session('status'))
<div class="alert alert-success">
    {{ session('status') }}
</div>
@endif
<table class="table text-center">
    <thead class="thead-dark">
        <tr>
            <th scope="col">Nombre</th>
            <th scope="col">Email</th>
            <th scope="col">Editar</th>
            <th scope="col">Eliminar</th>
        </tr>
        <tr>
            <td>{{Auth::user()->name}}</td>
            <td>{{Auth::user()->email}}</td>
            <td>
                <a href="{{route('user.edit',Auth::user()->id)}}" class="btn btn-warning ">Editar usuario</a>
            </td>
            <td>
                <form action="{{route('user.destroy',Auth::user()->id)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="submit" class="btn btn-danger" value="Eliminar cuenta">
                </form>
            </td>
        </tr>
    </thead>
</table>
<table class="table text-center">
    <thead class="thead-dark">
        <tr>
            <th scope="col">Puntuaciones Snake</th>
        </tr>
        @foreach ($users as $user)
        @if($user->id == Auth::user()->id )
        @foreach ($user->snake as $puntosSnake)
        <tr>
            <td><b>{{$puntosSnake->score}}</b></td>
        </tr>
        @endforeach
        @endif
        @endforeach
    </thead>
</table>
<table class="table text-center">
    <thead class="thead-dark">
        <tr>
            <th scope="col">Puntuaciones Buscaminas</th>
        </tr>
        @foreach ($users as $user)
        @if($user->id == Auth::user()->id )
        @foreach ($user->mine as $puntos)
        <tr>
            <td><b>{{$puntos->minutos}}:{{$puntos->segundos}}:{{$puntos->centesimas}}</b></td>
        </tr>
        @endforeach
        @endif
        @endforeach
    </thead>
</table>
@endsection

<thead class="thead-dark">
    <tr>
        <th scope="col">Puntuaciones Snake</th>
        <th scope="col">Puntuaciones Buscaminas</th>
    </tr>
    @foreach ($users as $user)
    @if($user->id == Auth::user()->id )
    @foreach ($user->snake as $puntosSnake)
    <tr>
        <td><b>{{$puntosSnake->score}}</b></td>
    </tr>
    @endforeach
    @endif
    @endforeach
    @foreach ($users as $user)
    @if($user->id == Auth::user()->id )
    @foreach ($user->mine as $puntos)
    <tr>
        <td>{{$user->name}} → <b>{{$puntos->minutos}}:{{$puntos->segundos}}:{{$puntos->centesimas}}</b></td>
    </tr>
    @endforeach
    @endif
    @endforeach
</thead>