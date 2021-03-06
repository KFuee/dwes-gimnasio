<?php

namespace App\Http\Controllers;

use App\Models\Activity;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable vista de listado
     */
    public function index()
    {
        $activities = Activity::all();
        return view('home', ['activities' => $activities]);
    }
}
