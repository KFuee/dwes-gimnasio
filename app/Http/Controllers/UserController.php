<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
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
        $users = User::all();
        return view('users.list', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View vista de creación
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Contracts\View\View vista de mostrar
     */
    public function show(User $user)
    {
        return view('users.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Contracts\View\View vista de edición
     */
    public function edit(User $user)
    {
        return view('users.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request  $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\RedirectResponse activities.index
     */
    public function update(Request $request, User $user)
    {
        $user->update([
            'dni' => $request->dni,
            'name' => $request->name,
            'weight' => $request->weight,
            'height' => $request->height,
            'birthdate' => $request->birthdate,
            'gender' => $request->gender,
        ]);

        return Redirect::route('users.index')
            ->with('success', 'Usuario #' . $user->id . ' actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return Redirect::route('users.index')
            ->with('success', 'Usuario #' . $user->id . ' eliminado correctamente');
    }
}
