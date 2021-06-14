@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Editar usuario</h4>
    <div class="row">
        <div class="col-xl-12">
            <form action="{{route('user.update',Auth::user()->id)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input type="text" class="form-control" name="name" required maxlength="15" value="{{Auth::user()->name}}">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" name="email" required maxlength="50" value="{{Auth::user()->email}}">
                </div>
                <input class="btn btn-primary block" type="submit" value="Guardar usuario">
            </form>

        </div>
    </div>
</div>

@endsection