@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <div class="card border-primary mb-3">
        <div class="card-header d-flex justify-content-between align-items-center">
          {{ __('Listado de sesiones') }}
          <a href="{{ route('sessions.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i>
          </a>
        </div>

        <div class="card-body">
          @if ($sessions->isNotEmpty())
          <div class="table-responsive">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th scope="col">{{ __('Actividad') }}</th>
                  <th scope="col">{{ __('Fecha') }}</th>
                  <th scope="col">{{ __('Hora de inicio') }}</th>
                  <th scope="col">{{ __('Hora de fin') }}</th>
                  <th scope="col">{{ __('Participantes') }}</th>
                  <th scope="col">{{ __('Acciones') }}</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($sessions as $session)
                <tr>
                  <td>{{ $session->activity->name }}</td>
                  <td>{{ $session->date }}</td>
                  <td>{{ $session->start_time }}</td>
                  <td>{{ $session->end_time }}</td>
                  <td>{{ $session->participants->count() }}</td>
                  <td>
                    <a href="{{ route('sessions.show', $session) }}" class="btn btn-primary btn-sm">
                      <i class="fas fa-eye"></i>
                    </a>
                    <a href="{{ route('sessions.edit', $session) }}" class="btn btn-warning btn-sm">
                      <i class="fas fa-edit"></i>
                    </a>
                    <form action="{{ route('sessions.destroy', $session) }}" method="POST" class="d-inline">
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
          No se han encontrado sesiones.
          @endif
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