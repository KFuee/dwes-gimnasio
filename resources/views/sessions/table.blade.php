@if ($sessions->isNotEmpty())
<div class="table-responsive">
  <table class="table table-hover">
    <thead>
      <tr>
        @if ($sessionsView)
        <th scope="col">{{ __('Actividad') }}</th>
        @endif
        <th scope="col">{{ __('Fecha') }}</th>
        <th scope="col">{{ __('Hora de inicio') }}</th>
        <th scope="col">{{ __('Hora de fin') }}</th>
        <th scope="col">{{ __('Acciones') }}</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($sessions as $session)
      <tr>
        @if ($sessionsView)
        <td>{{ $session->activity->name }}</td>
        @endif
        <td>{{ Carbon\Carbon::parse($session->date)->format('d-m-Y') }}</td>
        <td>{{ $session->start_time }}</td>
        <td>{{ $session->end_time }}</td>
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