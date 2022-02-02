@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <div class="card border-primary mb-3">
        <div class="card-header">Modificar actividad. ID: {{ $activity->id }}</div>

        <div class="card-body">
          <form method="POST" action="{{ route('activities.update', ['activity' => $activity]) }}">
            @method('PATCH')

            @csrf

            <div class="row mb-3">
              <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Nombre') }}</label>

              <div class="col-md-6">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $activity->name }}" required autocomplete="name" autofocus>

                @error('name')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="row mb-3">
              <label for="description" class="col-md-4 col-form-label text-md-end">{{ __('Descripción') }}</label>

              <div class="col-md-6">
                <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" required autocomplete="description">{{ $activity->description }}</textarea>

                @error('description')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="row mb-3">
              <label for="duration" class="col-md-4 col-form-label text-md-end">{{ __('Duración') }}</label>

              <div class="col-md-6">
                <input id="duration" type="number" class="form-control @error('duration') is-invalid @enderror" name="duration" value="{{ $activity->duration }}" required autocomplete="duration">

                @error('duration')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="row mb-3">
              <label for="max_participants" class="col-md-4 col-form-label text-md-end">{{ __('Participantes') }}</label>

              <div class="col-md-6">
                <input id="max_participants" type="number" class="form-control @error('max_participants') is-invalid @enderror" name="max_participants" value="{{ $activity->max_participants }}" required autocomplete="max_participants">

                @error('max_participants')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="row mb-0">
              <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                  {{ __('Modificar actividad') }}
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