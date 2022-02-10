@if ($appointments->isNotEmpty())
<div class="table-responsive">
  <table class="table table-bordered table-hover">
    <thead>
      <tr class="table-primary">
        <th scope="col">#</th>
        <th scope="col">Fecha</th>
        <th scope="col">Sesión</th>
        <th scope="col">Usuario</th>
        <th scope="col">Acciones</th>
      </tr>
    </thead>

    <tbody>
      @foreach($appointments as $appointment)
      <tr class="table-secondary">
        <th scope="row">{{ $appointment->id }}</th>
        <td>{{ $appointment->created_at }}</td>
        <td>{{ $appointment->session->date }} {{ Carbon\Carbon::parse($appointment->session->start_time)->format('H:i') }}</td>
        <td>{{ $appointment->user->dni }}</td>
        <td>
          @if (Auth::user()->isAdministrator())
          <a href="{{ route('appointments.show', $appointment->id) }}" class="btn btn-primary btn-sm">
            <i class="fas fa-eye"></i>
          </a>
          @endif

          <form method="POST" action="{{ route('appointments.destroy', $appointment->id) }}" class="d-inline">
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
No se han encontrado reservas.
@endif