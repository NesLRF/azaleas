@extends('layouts.app')

@section('title')
    Registro de usuarios
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-6">
                <div class="row">
                    <form action="{{route('user_i')}}" method="POST">
                        @csrf
                        <div class="col-md-6">
                            <input type="file" name="document">
                        </div>
                        <div class="col-md-6">
                            <button class="btn btn-primary" type="submit">Importar</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-2">
                <button class="btn btn-success">Export</button>
            </div>
        </div>
    </div>
@endsection