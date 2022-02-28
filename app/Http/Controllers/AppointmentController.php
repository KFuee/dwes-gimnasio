<?php

namespace App\Http\Controllers;

use App\Mail\AppointmentConfirmation;
use App\Models\Appointment;
use App\Models\Activity;
use App\Models\Session;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

class AppointmentController extends Controller
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
     * @return \Illuminate\Contracts\Support\Renderable vista de listado
     */
    public function index()
    {
        $isAdministrator = Auth::user()->role->id === 2;

        // Obtiene el usuario autenticado
        if ($isAdministrator) {
            // Obtiene todas las reservas
            $appointments = Appointment::paginate(5);
        } else {
            // Obtiene las reservas del usuario autenticado
            $appointments = Appointment::where('user_id', Auth::user()->id)->paginate(5);
        }

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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Appointment::create([
            'session_id' => $request->session_id,
            'user_id' => $request->user_id,
        ]);

        // Envía un correo electrónico al usuario
        $this->confirmationMail($request);

        return Redirect::route('home')
            ->with('success', 'Reserva creada correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Appointment $appointment
     * @return \Illuminate\Contracts\Support\Renderable vista de mostrar
     */
    public function show(Appointment $appointment)
    {
        $session = $appointment->session;
        $user = $appointment->user;

        return view('appointments.show', [
            'appointment' => $appointment,
            'session' => $session,
            'user' => $user
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Appointment $appointment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Appointment $appointment)
    {
        $appointment->delete();

        return Redirect::route('appointments.index')
            ->with('success', 'Reserva de ' . strtolower($appointment->session->activity->name) . ' eliminada correctamente');
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

    public function confirmationMail(Request $request)
    {
        $user = User::find($request->user_id);
        $userName = $user->name;
        $userMail = $user->email;

        $activityName = Session::find($request->session_id)->activity->name;

        $session = Session::find($request->session_id);
        $sessionDate = Carbon::parse($session->date);
        $sessionStartTime = $session->start_time;
        $sessionEndTime = $session->end_time;

        Mail::to($userMail)->send(
            new AppointmentConfirmation(
                $userName,
                $activityName,
                $sessionDate,
                $sessionStartTime,
                $sessionEndTime
            )
        );
    }
}
