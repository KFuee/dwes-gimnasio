@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <div class="card border-primary mb-3">
        <div class="card-header">Mostrar reserva</div>
        <div class="card-body">
          <ul class="list-group list-group-flush">
            <li class="list-group-item">ID: {{ $appointment->id }}</li>
            <li class="list-group-item">Fecha de creación: {{ $appointment->created_at }}</li>
          </ul>
        </div>

        @include('sessions.data', ['showSessionView' => false])

        @include('users.data', ['showUserView' => false])
      </div>
    </div>
  </div>
</div>
@endsection