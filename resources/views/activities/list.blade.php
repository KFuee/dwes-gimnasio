@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <div class="card">
        <div class="card-header">{{ __('Listado de actividades') }}</div>

        <div class="card-body">
          @if ($activities->isNotEmpty())
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Nombre</th>
                  <th scope="col">Descripción</th>
                  <th scope="col">Duración</th>
                  <th scope="col">Máximo participantes</th>
                  <th scope="col">Acciones</th>
                </tr>
              </thead>

              <tbody>
                @foreach($activities as $activity)
                <tr>
                  <th scope="row">{{ $activity->id }}</th>
                  <td>{{ $activity->name }}</td>
                  <td>{{ $activity->description }}</td>
                  <td>{{ $activity->duration }}</td>
                  <td>{{ $activity->max_participants }}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          @else
          No se han encontrado actividades.
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
@endsection