@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <div class="card border-primary mb-3">
        <div class="card-header d-flex justify-content-between align-items-center">
          {{ __('Listado de reservas') }}
          <a href="{{ route('appointments.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i>
          </a>
        </div>

        <div class="card-body">
          @if ($appointments->isNotEmpty())
          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead>
                <tr class="table-primary">
                  <th scope="col">#</th>
                  <th scope="col">Fecha</th>
                  <th scope="col">Sesión</th>
                  <th scope="col">Usuario</th>
                  <th scope="col">Acciones</th>
                </tr>
              </thead>

              <tbody>
                @foreach($appointments as $appointment)
                <tr class="table-secondary">
                  <th scope="row">{{ $appointment->id }}</th>
                  <td>{{ $appointment->name }}</td>
                  <td>{{ $appointment->duration }}</td>
                  <td>{{ $appointment->max_participants }}</td>
                  <td>
                    <a href="{{ route('appointments.show', $appointment->id) }}" class="btn btn-primary btn-sm">
                      <i class="fas fa-eye"></i>
                    </a>
                    <a href="{{ route('appointments.edit', $appointment->id) }}" class="btn btn-warning btn-sm">
                      <i class="fas fa-edit"></i>
                    </a>
                    <form method="POST" action="{{ route('appointments.destroy', $appointment->id) }}" class="d-inline">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger btn-sm">
                        <i class="fas fa-trash"></i>
                      </button>
                    </form>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          @else
          No se han encontrado reservas.
          @endif
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