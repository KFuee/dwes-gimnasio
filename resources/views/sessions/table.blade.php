@if ($sessions->isNotEmpty())
<div class="table-responsive">
  <table class="table table-bordered table-hover">
    <thead>
      <tr class="table-primary">
        <th>#</th>
        @if ($sessionsView)
        <th scope="col">{{ __('Actividad') }}</th>
        @endif
        <th scope="col">{{ __('Fecha') }}</th>
        <th scope="col">{{ __('Hora de inicio') }}</th>
        <th scope="col">{{ __('Hora de fin') }}</th>
        <th scope="col">{{ __('Usuarios apuntados') }}</th>
        <th scope="col">{{ __('Acciones') }}</th>
      </tr>
    </thead>

    <tbody>
      @foreach ($sessions as $session)
      <tr class="table-secondary">
        <td>{{ $session->id }}</td>
        @if ($sessionsView)
        <td>{{ $session->activity->name }}</td>
        @endif
        <td>{{ Carbon\Carbon::parse($session->date)->translatedFormat('l') }},
          {{ Carbon\Carbon::parse($session->date)->format('d-m-Y') }}
        </td>
        <td>{{ Carbon\Carbon::parse($session->start_time)->format('H:i') }}</td>
        <td>{{ Carbon\Carbon::parse($session->end_time)->format('H:i') }}</td>
        <td>{{ $session->appointments->count() !== 0 ? $session->appointments->count() : 'Ninguno' }}</td>
        @if($appointmentView)
        <td>
          <form action="{{ route('appointments.store', ['session_id' => $session->id, 'user_id'=> Auth::id()]) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary btn-sm">
              <i class="fas fa-calendar-check me-2"></i>Reservar
            </button>
          </form>
        </td>
        @else
        <td>
          <a href="{{ route('sessions.show', $session) }}" class="btn btn-primary btn-sm">
            <i class="fas fa-eye"></i>
          </a>
          <form action="{{ route('sessions.destroy', $session) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm">
              <i class="fas fa-trash"></i>
            </button>
          </form>
        </td>
        @endif
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@else
No se han encontrado sesiones.
@endif