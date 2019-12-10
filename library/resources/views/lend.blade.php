@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Mis prestamos</h1>
    <div class="container">
            <form action="showmylends" method="GET" role="search">
                {{ csrf_field() }}
                <div class="input-group">
                    <input type="text" class="form-control" name="q"
                        placeholder="Buscar prestamo"> <span class="input-group-btn">
                        <button type="submit" class="btn btn-primary">buscar
                        </button>
                    </span>
                </div>
            </form>
        @if(isset($loans))

        
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Libro</th>
                    <th>fecha de prestamo</th>
                    <th>fecha de devolucion</th>
                </tr>
            </thead>
            <tbody>
                @foreach($loans as $loan)
                <tr>
                    <td>{{$loan->libro_id}}</td>
                    <td>{{$loan->fecha_prestamo}}</td>
                    <td>{{$loan->fecha_devolucion}}</td>
                    
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
        <a class="btn btn-primary" href="{{ url('api/showmylends') }}">Ver todos</a>
        <a class="btn btn-primary" href="{{ url('home') }}">Volver a la Home</a>
    </div>
    
</div>
@endsection
@section('content')
@endsection
