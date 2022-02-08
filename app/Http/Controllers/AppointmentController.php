<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Activity;
use App\Models\Session;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Support\Renderable vista de listado
     */
    public function index()
    {
        $appointments = Appointment::all();
        return view('appointments.list', ['appointments' => $appointments]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Support\Renderable vista de creación
     */
    public function create()
    {
        if (Activity::count() == 0) {
            return Redirect::route('home')
                ->with('error', 'No hay actividades disponibles para reservar');
        }

        // Comprueba si hay sesiones disponibles
        if (Session::count() == 0) {
            return Redirect::route('home')
                ->with('error', 'No hay sesiones disponibles para reservar');
        }

        return view('appointments.create', ['activities' => $this->activities()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function show(Appointment $appointment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function edit(Appointment $appointment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Appointment $appointment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Appointment $appointment)
    {
        //
    }

    // Devuelve las actividades disponibles para reservar en JSON
    public function activities()
    {
        $activities = Activity::all();

        $availableActivities = [];
        foreach ($activities as $activity) {
            if ($activity->isAvailable()) {
                array_push($availableActivities, $activity);
            }
        }

        return $availableActivities;
    }

    // Devuelve el nombre de los meses con sesiones disponibles para reservar en JSON
    public function months(Activity $activity)
    {
        $sessions = $activity->sessions;

        $availableMonths = [];
        foreach ($sessions as $session) {
            $date = Carbon::parse($session->date);
            $month = $date->translatedFormat('F');
            if (!in_array($month, $availableMonths)) {
                array_push($availableMonths, $month);
            }
        }

        return $availableMonths;
    }

    // Devuelve las sesiones disponibles para reservar en JSON
    public function sessions(Activity $activity, $month)
    {
        $sessions = $activity->sessions;

        $availableSessions = [];
        foreach ($sessions as $session) {
            $date = Carbon::parse($session->date);
            $sessionMonth = $date->translatedFormat('F');
            if ($sessionMonth == $month) {
                array_push($availableSessions, $session);
            }
        }

        return view('sessions.table', [
            'sessionsView' => false,
            'appointmentView' => true,
            'sessions' => collect($availableSessions)
        ]);
    }
}
