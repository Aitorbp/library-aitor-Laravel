@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Buscador</h1>
    <div class="container">
            <form action="search" method="GET" role="search">
                {{ csrf_field() }}
                <div class="input-group">
                    <input type="text" class="form-control" name="q"
                        placeholder="Buscar libro"> <span class="input-group-btn">
                        <button type="submit" class="btn btn-primary">buscar
                        </button>
                    </span>
                </div>
            </form>
        @if(isset($books))

        
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Autor</th>
                    <th>Género</th>
                    <th>Descripción</th>
                </tr>
            </thead>
            <tbody>
                @foreach($books as $libro)
                <tr>
                    <td>{{$libro->nombre}}</td>
                    <td>{{$libro->autor}}</td>
                    <td>{{$libro->genero}}</td>
                    <td>{{$libro->descripcion}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
        <a class="btn btn-primary" href="{{ url('api/search') }}">Ver todos</a>
        <a class="btn btn-primary" href="{{ url('home') }}">Volver a la Home</a>
    </div>
    
</div>
@endsection
@section('content')
@endsection
