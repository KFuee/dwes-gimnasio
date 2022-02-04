@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card border-primary mb-3">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if ($activities->isNotEmpty())
                    <!-- Recorre todas las actividades y crea una tarjeta por cada una -->
                    <!-- 3 columnas por fila -->
                    <div class="container">
                        <h3 class="mt-2 mb-4">Actividades disponibles</h3>

                        <div class="row">
                            @foreach($activities as $activity)
                            @if ($activity->sessions->isNotEmpty())
                            <div class="col-md-4">
                                <div class="card border-primary mb-3">
                                    <div class="card-header">{{ $activity->name }}</div>
                                    <div class="card-body">
                                        <p class="card-subtitle mb-2 text-muted">{{ $activity->duration }} minutos de duración</p>
                                        <p class="card-text">{{ $activity->description }}</p>
                                        <a href="{{ route('activities.show', $activity->id) }}" class="card-link">Reservar</a>
                                    </div>
                                    <div class="card-footer text-muted">
                                        {{ $activity->max_participants * $activity->sessions->count() }} plazas disponibles
                                    </div>
                                </div>
                            </div>
                            @endif
                            @endforeach
                        </div>
                    </div>
                    @else
                    No se han encontrado actividades.
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection