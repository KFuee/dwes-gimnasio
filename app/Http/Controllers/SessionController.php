<?php

namespace App\Http\Controllers;

use App\Models\Session;
use App\Models\Activity;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class SessionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View vista de listado
     */
    public function index()
    {
        $sessions = Session::all();
        return view('sessions.list', ['sessions' => $sessions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $activities = Activity::all();

        if (count($activities) == 0) {
            return Redirect::route('activities.create')
                ->with('error', 'Debes crear al menos una actividad antes de crear una sesión');
        }

        return view('sessions.create', ['activities' => $activities]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse sessions.index
     */
    public function store(Request $request)
    {
        // Array de días de la semana
        $days = $request->days;
        // Obtenemos la fecha en formato YYYY-MM-DD con el año y mes del campo date
        $date = Carbon::createFromDate($request->date);
        // Obtenemos la hora de inicio obtenida en el input de tipo time
        $time = Carbon::createFromFormat('H:i', $request->start_time);

        function addSession($activityId, $date, $time)
        {
            // Obtiene la duración de la actividad
            $activity = Activity::find($activityId);
            $duration = $activity->duration;

            // Suma la duración de la sesión a startTimeFinal
            $endTime = $time->copy()->addMinutes($duration);

            Session::create([
                'activity_id' => $activityId,
                'date' => $date,
                'start_time' => $time,
                'end_time' => $endTime
            ]);
        }

        $count = 0;
        for ($i = 1; $i <= $date->daysInMonth; $i++) {
            if (($date->isMonday() && in_array('monday', $days)) ||
                ($date->isTuesday() && in_array('tuesday', $days)) ||
                ($date->isWednesday() && in_array('wednesday', $days)) ||
                ($date->isThursday() && in_array('thursday', $days)) ||
                ($date->isFriday() && in_array('friday', $days)) ||
                ($date->isSaturday() && in_array('saturday', $days)) ||
                ($date->isSunday() && in_array('sunday', $days))
            ) {
                $count++;
                addSession($request->activity_id, $date, $time);
            }

            $date->addDay();
        }

        return Redirect::route('sessions.index')
            ->with('success', $count . ' sesiones creadas correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Session $session
     * @return \Illuminate\Contracts\View\View vista de mostrar
     */
    public function show(Session $session)
    {
        return view('sessions.show', ['session' => $session]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function edit(Session $session)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Session $session)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function destroy(Session $session)
    {
        //
    }
}
