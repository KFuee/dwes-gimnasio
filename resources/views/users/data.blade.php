@if ($showUserView)
<div class="card-header">Mostrar usuario</div>
@else
<div class="card-header">Datos del usuario</div>
@endif
<div class="card-body">
  <ul class="list-group list-group-flush">
    @if (Auth::user()->isAdministrator())
    <li class="list-group-item">ID: {{ $user->id }}</li>
    @endif
    <li class="list-group-item">Rol: {{ $user->role->name }}</li>
    <li class="list-group-item">DNI: {{ $user->dni }}</li>
    <li class="list-group-item">Nombre completo: {{ $user->name }}</li>
    <li class="list-group-item">Email: {{ $user->email }}</li>
    <li class="list-group-item">Peso: {{ $user->weight }}</li>
    <li class="list-group-item">Altura: {{ $user->height }}</li>
    <li class="list-group-item">Fecha de nacimiento: {{ $user->birthdate }}</li>
    <li class="list-group-item">Sexo: {{ $user->gender }}</li>
</div>