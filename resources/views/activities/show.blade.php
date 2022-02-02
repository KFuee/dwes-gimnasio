@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <div class="card border-primary mb-3">
        <div class="card-header">Mostrar actividad</div>
        <div class="card-body">
          <ul class="list-group list-group-flush">
            <li class="list-group-item">ID: {{ $activity->id }}</li>
            <li class="list-group-item">Nombre de la actividad: {{ $activity->name }}</li>
            <li class="list-group-item">Descripción: {{ $activity->description }}</li>
            <li class="list-group-item">Duración en minutos: {{ $activity->duration }}</li>
            <li class="list-group-item">Número máximo de participantes: {{ $activity->max_participants }}</li>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
@endsection