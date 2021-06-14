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
            <th scope="col"></th>
            <th scope="col"></th>
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
    <tbody>
    </tbody>
</table>

@endsection