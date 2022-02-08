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

        <!-- Muestra las sesiones de la actividad en una tabla -->
        <div class="card-header">Sesiones de la actividad</div>
        <div class="card-body">
          @include('sessions.table', ['sessionsView' => false, 'appointmentView' => false])
        </div>

        @if ($sessions->isNotEmpty())
        <div class="card-footer text-muted">
          Número de registros encontrados: {{ $sessions->count() }}
        </div>
        @endif
      </div>
    </div>
  </div>
</div>
@endsection