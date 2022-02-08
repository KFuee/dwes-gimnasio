@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <div class="card border-primary mb-3">
        <div class="card-header">
          {{ __('Búsqueda de sesiones') }}
        </div>

        <div class="card-body">
          <form method="POST" action="{{ route('appointments.store') }}">
            @csrf

            <div class="row mb-3">
              <label for="activity_id" class="col-md-4 col-form-label text-md-end">{{ __('Actividad') }}</label>

              <div class="col-md-6">
                <select id="activity_id" class="form-control{{ $errors->has('activity_id') ? ' is-invalid' : '' }}" name="activity_id" required>
                  <option value="">Seleccione una actividad</option>
                  @foreach ($activities as $activity)
                  <option value="{{ $activity->id }}" {{ old('activity_id') == $activity->id ? 'selected' : '' }}>{{ $activity->name }}</option>
                  @endforeach
                </select>

                @error('activity_id')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <!-- Selector de mes -->
            <div class="row mb-3" style="display: none;">
              <label for="month" class="col-md-4 col-form-label text-md-end">{{ __('Mes') }}</label>

              <div class="col-md-6">
                <select id="month" class="form-control{{ $errors->has('month') ? ' is-invalid' : '' }}" name="month" required>
                </select>

                @error('month')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
          </form>
        </div>

        <!-- Muestra las sesiones disponibles en una tabla -->
        <div style="display: none;">
          <div class="card-header">Sesiones disponibles para reservar</div>
          <div class="card-body">
            <div id="available_sessions"></div>
          </div>

          <div class="card-footer text-muted">
            Número de registros encontrados: <span id="available_sessions_count"></span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  // Una vez se selecciona una actividad, se muestran los meses disponibles
  $('#activity_id').change(function() {
    var activity_id = $(this).val();

    $.ajax({
      url: '/appointments/months/' + activity_id,
      type: 'GET',
      dataType: 'json',
      success: function(data) {
        $('#month').empty();

        $('#month').append('<option value="">Seleccione un mes</option>');

        $.each(data, function(index, month) {
          $('#month').append('<option value="' + month + '">' + month + '</option>');
        });
      }
    });

    // Deja de ocultar el div de meses
    $('#month').parent().parent().show();
  });

  // Una vez se selecciona un mes, se muestran las sesiones disponibles
  $('#month').change(function() {
    var month = $(this).val();
    var activity_id = $('#activity_id').val();

    $.ajax({
      url: '/appointments/sessions/' + activity_id + '/' + month,
      type: 'GET',
      dataType: 'html',
      success: function(data) {
        $('#available_sessions').html(data);
        $('#available_sessions_count').html($('#available_sessions tr').length - 1);
      }
    });

    // Deja de ocultar el div de sesiones
    $('#available_sessions').parent().parent().show();
  });
</script>
@endsection