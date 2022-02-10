@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <div class="card border-primary mb-3">
        @include('users.data')

        @if (Auth::user()->isAdministrator())
        <!-- Muestra las sesiones de la actividad en una tabla -->
        <div class="card-header">Reservas del usuario</div>

        <div class="card-body">
          @include('appointments.table', ['appointments' => $appointments])
        </div>

        @if ($appointments->isNotEmpty())
        <div class="card-footer text-muted">
          Número de registros encontrados: {{ $appointments->count() }}
        </div>
        @endif
        @endif
      </div>
    </div>
  </div>
</div>
</div>
@endsection