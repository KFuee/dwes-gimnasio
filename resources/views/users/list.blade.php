@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <div class="card border-primary mb-3">
        <div class="card-header">{{ __('Listado de usuarios') }}</div>

        <div class="card-body">
          @if ($users->isNotEmpty())
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr class="table-primary">
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
                @foreach($users as $user)
                <tr class="table-secondary">
                  <th scope="row">{{ $user->id }}</th>
                  <td>{{ $user->role->name }}</td>
                  <td>{{ $user->dni }}</td>
                  <td>{{ $user->name }}</td>
                  <td>{{ $user->email }}</td>
                  <td>{{ $user->weight }}</td>
                  <td>{{ $user->height }}</td>
                  <td>{{ $user->birthdate }}</td>
                  <td>{{ $user->gender }}</td>
                  <td>
                    <a href="{{ route('users.show', $user->id) }}" class="btn btn-primary btn-sm">
                      <i class="fas fa-eye"></i>
                    </a>
                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm">
                      <i class="fas fa-edit"></i>
                    </a>
                    <form method="POST" action="{{ route('users.destroy', $user->id) }}" class="d-inline">
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
          No se han encontrado usuarios.
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
@endsection