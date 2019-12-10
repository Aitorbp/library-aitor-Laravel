@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">
 
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
    <a class="btn btn-primary" href="{{ url('api/search') }}"> Ir al bucador</a>
    <a class="btn btn-primary" href="{{ url('api/showmylends') }}"> Ver mis prestamos</a>
    
</div>
@endsection
@section('content')
@endsection
