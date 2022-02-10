@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <div class="card border-primary mb-3">
        <div class="card-header d-flex justify-content-between align-items-center">
          {{ __('Listado de reservas') }}
          @if (Auth::user()->isAdministrator())
          <a href="{{ route('appointments.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i>
          </a>
          @endif
        </div>

        <div class="card-body">
          @include('appointments.table', ['appointments' => $appointments, 'showSessionInfo' => true])
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