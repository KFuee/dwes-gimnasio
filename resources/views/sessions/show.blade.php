@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <div class="card border-primary mb-3">
        @include('sessions.data')

        <!-- Muestra las reservas de la sesión en una tabla -->
        <div class="card-header">Reservas de la sesión</div>

        <div class="card-body">
          @include('appointments.table', ['appointments' => $appointments])
        </div>

        @if ($appointments->isNotEmpty())
        <div class="card-footer text-muted">
          Número de registros encontrados: {{ $appointments->count() }}
        </div>
        @endif
      </div>
    </div>
  </div>
</div>
@endsection