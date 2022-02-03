<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ActivityController extends Controller
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
        $activities = Activity::all();
        return view('activities.list', ['activities' => $activities]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Support\Renderable vista de creación
     */
    public function create()
    {
        return view('activities.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse activities.index
     */
    public function store(Request $request)
    {
        Activity::create([
            'name' => $request->name,
            'description' => $request->description,
            'duration' => $request->duration,
            'max_participants' => $request->max_participants,
        ]);

        return Redirect::route('activities.index')
            ->with('success', 'Actividad creada correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Activity $activity
     * @return \Illuminate\Contracts\Support\Renderable vista de mostrar
     */
    public function show(Activity $activity)
    {
        $sessions = $activity->sessions;
        return view('activities.show', ['activity' => $activity, 'sessions' => $sessions]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Activity $activity
     * @return \Illuminate\Contracts\Support\Renderable vista de edición
     */
    public function edit(Activity $activity)
    {
        return view('activities.edit', ['activity' => $activity]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Activity $activity
     * @return \Illuminate\Http\RedirectResponse activities.index
     */
    public function update(Request $request, Activity $activity)
    {
        $activity->update([
            'name' => $request->name,
            'description' => $request->description,
            'duration' => $request->duration,
            'max_participants' => $request->max_participants,
        ]);

        return Redirect::route('activities.index')
            ->with('success', 'Actividad #' . $activity->id . ' actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Activity  $activity
     * @return \Illuminate\Http\RedirectResponse activities.index
     */
    public function destroy(Activity $activity)
    {
        $activity->delete();

        return Redirect::route('activities.index')
            ->with('success', 'Actividad #' . $activity->id . ' y sus sesiones se han eliminado correctamente');
    }
}
