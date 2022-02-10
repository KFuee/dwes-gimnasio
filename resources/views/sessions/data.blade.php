@if ($showSessionView)
<div class="card-header">Mostrar sesión</div>
@else
<div class="card-header">Datos de la sesión</div>
@endif
<div class="card-body">
  <ul class="list-group list-group-flush">
    <li class="list-group-item">ID: {{ $session->id }}</li>
    <li class="list-group-item">Actividad: {{ $session->activity->name }}</li>
    <li class="list-group-item">Fecha: {{ Carbon\Carbon::parse($session->date)->format('d-m-Y') }}</li>
    <li class="list-group-item">Hora de inicio: {{ $session->start_time }}</li>
    <li class="list-group-item">Hora de fin: {{ $session->end_time }}</li>
  </ul>
</div>