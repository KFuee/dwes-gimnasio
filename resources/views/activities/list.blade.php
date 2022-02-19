@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <div class="card border-primary mb-3">
        <div class="card-header d-flex justify-content-between align-items-center">
          {{ __('Listado de actividades') }}
          <a href="{{ route('activities.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i>
          </a>
        </div>

        <div class="card-body">
          @if ($activities->isNotEmpty())
          <p>Para visualizar la descripción entra en la información de una actividad específica.</p>
          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead>
                <tr class="table-primary">
                  <th scope="col">#</th>
                  <th scope="col">Nombre</th>
                  <th scope="col">Duración</th>
                  <th scope="col">Máximo participantes</th>
                  <th scope="col">Acciones</th>
                </tr>
              </thead>

              <tbody>
                @foreach($activities as $activity)
                <tr class="table-secondary">
                  <th scope="row">{{ $activity->id }}</th>
                  <td>{{ $activity->name }}</td>
                  <td>{{ $activity->duration }}</td>
                  <td>{{ $activity->max_participants }}</td>
                  <td>
                    <a href="{{ route('activities.show', $activity->id) }}" class="btn btn-primary btn-sm">
                      <i class="fas fa-eye"></i>
                    </a>
                    <a href="{{ route('activities.edit', $activity->id) }}" class="btn btn-warning btn-sm">
                      <i class="fas fa-edit"></i>
                    </a>
                    <form method="POST" action="{{ route('activities.destroy', $activity->id) }}" class="d-inline">
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

            {!! $activities->links() !!}
          </div>
          @else
          No se han encontrado actividades.
          @endif
        </div>

        @if ($activities->isNotEmpty())
        <div class="card-footer text-muted">
          Número de registros encontrados: {{ $activities->count() }}
        </div>
        @endif
      </div>
    </div>
  </div>
</div>
@endsection