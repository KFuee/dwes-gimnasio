@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <div class="card border-primary mb-3">
        <div class="card-header">{{ __('Crear sesión') }}</div>

        <div class="card-body">
          <form method="POST" action="{{ route('sessions.store') }}">
            @csrf

            <div class="row mb-3">
              <label for="activity_id" class="col-md-4 col-form-label text-md-end">{{ __('Actividad') }}</label>

              <div class="col-md-6">
                <select id="activity_id" class="form-control{{ $errors->has('activity_id') ? ' is-invalid' : '' }}" name="activity_id" required>
                  @if ($activities->isEmpty())
                  <option value="">No hay actividades disponibles</option>
                  @else
                  <option value="">Seleccione una actividad</option>
                  @foreach ($activities as $activity)
                  <option value="{{ $activity->id }}" {{ old('activity_id') == $activity->id ? 'selected' : '' }}>{{ $activity->name }}</option>
                  @endforeach
                  @endif
                </select>

                @error('activity_id')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <!-- Selector de mes -->
            <div class="row mb-3">
              <label for="date" class="col-md-4 col-form-label text-md-end">{{ __('Mes') }}</label>

              <div class="col-md-6">
                <input id="date" type="month" class="form-control{{ $errors->has('date') ? ' is-invalid' : '' }} d-inline-block" name="date" value="{{ old('date') }}" required>

                @error('date')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <!-- Selección de días de la semana con select múltiple de lunes a viernes -->
            <div class="row mb-3">
              <label for="days" class="col-md-4 col-form-label text-md-end">{{ __('Días') }}</label>

              <div class="col-md-6">
                <select id="days" class="form-control{{ $errors->has('days') ? ' is-invalid' : '' }}" name="days[]" multiple="multiple" required>
                  <option value="monday" {{ old('days') == 1 ? 'selected' : '' }}>Lunes</option>
                  <option value="tuesday" {{ old('days') == 2 ? 'selected' : '' }}>Martes</option>
                  <option value="wednesday" {{ old('days') == 3 ? 'selected' : '' }}>Miércoles</option>
                  <option value="thursday" {{ old('days') == 4 ? 'selected' : '' }}>Jueves</option>
                  <option value="friday" {{ old('days') == 5 ? 'selected' : '' }}>Viernes</option>
                </select>

                @error('days')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <!-- Selector de hora de inicio -->
            <div class="row mb-3">
              <label for="start_time" class="col-md-4 col-form-label text-md-end">{{ __('Hora de inicio') }}</label>

              <div class="col-md-6">
                <input id="start_time" type="time" class="form-control{{ $errors->has('start_time') ? ' is-invalid' : '' }} d-inline-block" name="start_time" value="{{ old('start_time') }}" required>

                @error('start_time')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="row mb-0">
              <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                  {{ __('Crear sesión') }}
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection