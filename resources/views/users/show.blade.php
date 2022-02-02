@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <div class="card border-primary mb-3">
        <div class="card-header">Mostrar usuario</div>
        <div class="card-body">
          <ul class="list-group list-group-flush">
            <li class="list-group-item">ID: {{ $user->id }}</li>
            <li class="list-group-item">Rol: {{ $user->role->name }}</li>
            <li class="list-group-item">DNI: {{ $user->dni }}</li>
            <li class="list-group-item">Nombre completo: {{ $user->name }}</li>
            <li class="list-group-item">Email: {{ $user->email }}</li>
            <li class="list-group-item">Peso: {{ $user->weight }}</li>
            <li class="list-group-item">Altura: {{ $user->height }}</li>
            <li class="list-group-item">Fecha de nacimiento: {{ $user->birthdate }}</li>
            <li class="list-group-item">Sexo: {{ $user->gender }}</li>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
@endsection