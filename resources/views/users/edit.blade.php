@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <div class="card border-primary mb-3">
        <div class="card-header">Modificar usuario. ID: {{ $user->id }}</div>

        <div class="card-body">
          <form method="POST" action="{{ route('users.update', ['user' => $user]) }}">
            @csrf
            @method('PATCH')

            <div class="row mb-3">
              <label for="dni" class="col-md-4 col-form-label text-md-end">{{ __('DNI') }}</label>

              <div class="col-md-6">
                <input id="dni" type="dni" class="form-control @error('dni') is-invalid @enderror" name="dni" value="{{ $user->dni }}" required autocomplete="dni" autofocus>

                @error('dni')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="row mb-3">
              <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Nombre') }}</label>

              <div class="col-md-6">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name">

                @error('name')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="row mb-3">
              <label for="weight" class="col-md-4 col-form-label text-md-end">{{ __('Peso') }}</label>

              <div class="col-md-6">
                <input id="weight" type="number" class="form-control @error('weight') is-invalid @enderror" name="weight" value="{{ $user->weight }}" required autocomplete="weight">

                @error('weight')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="row mb-3">
              <label for="height" class="col-md-4 col-form-label text-md-end">{{ __('Altura') }}</label>

              <div class="col-md-6">
                <input id="height" type="number" class="form-control @error('height') is-invalid @enderror" name="height" value="{{ $user->height }}" required autocomplete="height">

                @error('height')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="row mb-3">
              <label for="birthdate" class="col-md-4 col-form-label text-md-end">{{ __('Fecha de nacimiento') }}</label>

              <div class="col-md-6">
                <input id="birthdate" type="date" class="form-control @error('birthdate') is-invalid @enderror" name="birthdate" value="{{ $user->birthdate }}" required autocomplete="birthdate">

                @error('birthdate')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="row mb-3">
              <label for="gender" class="col-md-4 col-form-label text-md-end">{{ __('Sexo') }}</label>

              <div class="col-md-6">
                <!-- Selector de género -->
                <select id="gender" class="form-select @error('gender') is-invalid @enderror" name="gender" required autocomplete="gender">
                  <option value="" selected>Selecciona una opción</option>
                  <option value="male" {{ $user->gender == 'male' ? 'selected' : '' }}>Masculino</option>
                  <option value="female" {{ $user->gender == 'female' ? 'selected' : '' }}>Femenino</option>
                </select>

                @error('gender')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="row mb-0">
              <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                  {{ __('Modificar usuario') }}
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