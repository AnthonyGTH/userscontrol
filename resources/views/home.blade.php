@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">Control de usuarios</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Email</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach ($users as $user)
                            <tr>
                                <th scope="row">{{ $user->id }}</th>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td class="td-actions text-right">

                                        <a href="/usuarios/preEdit/{{$user->id}}" class="btn btn-info">Editar</a>
                                        <a href="/usuarios/delete/{{$user->id}}" class="btn btn-danger">Eliminar</a>


                								</td>
                            </tr>
                          @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">Opciones</div>

                <div class="card-body">
                    <a href="{{url('/usuarios/create')}}" class="btn btn-primary">Crear Usuario Nuevo</a>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
