@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <div class="card">
        <div class="card-header">{{ __('Listado de usuarios') }}</div>

        <div class="card-body">
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Rol</th>
                  <th scope="col">DNI</th>
                  <th scope="col">Nombre</th>
                  <th scope="col">Email</th>
                  <th scope="col">Peso</th>
                  <th scope="col">Altura</th>
                  <th scope="col">Fecha de nacimiento</th>
                  <th scope="col">Género</th>
                  <th scope="col">Acciones</th>
                </tr>
              </thead>

              <tbody>
                <tr>
                  @foreach($users as $user)
                  <th scope="row">{{ $user->id }}</th>
                  <td>{{ $user->role->name }}</td>
                  <td>{{ $user->dni }}</td>
                  <td>{{ $user->name }}</td>
                  <td>{{ $user->email }}</td>
                  <td>{{ $user->weight }}</td>
                  <td>{{ $user->height }}</td>
                  <td>{{ $user->birthdate }}</td>
                  <td>{{ $user->gender }}</td>
                  @endforeach
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection