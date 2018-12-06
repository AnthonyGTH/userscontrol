@extends('layouts.app')

@section('content')
<body>
<div class="container">

<h1>Editar {{ $user->name }}</h1>

<!-- if there are creation errors, they will show here -->
<form method="post" action="/usuarios/edit/{{$user->id}}">
  {{ csrf_field() }}
  <div class="form-group">
    <label for="exampleInputEmail1">Nombre</label>
    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Inserta nombre" name="name"  value="{{ $user->name }}">
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Correo</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Inserta correo electronico" name="email"  value="{{ $user->email }}">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Clave</label>
    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Clave" name="password" >
  </div>
  <div class="form-group">
    <label for="exampleInputPassword2">Reinserte clave</label>
    <input type="password" class="form-control" id="exampleInputPassword2" placeholder="Re INSERTAR" name="password_confirmation" >
  </div>
  <a href="{{url('/home')}}" class="btn btn-primary">Cancelar</a>
  <button type="submit" class="btn btn-primary">Actualizar</button>
</form>


</div>
@endsection
