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
        $this->middleware('isAdmin')->except('show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Support\Renderable vista de listado
     */
    public function index()
    {
        $users = User::paginate(5);
        return view('users.list', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Support\Renderable vista de creación
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Contracts\Support\Renderable vista de mostrar
     */
    public function show(User $user)
    {
        $appointments = $user->appointments;

        return view('users.show', [
            'user' => $user,
            'appointments' => $appointments,
            'showUserView' => true,
            'showSessionInfo' => true,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Contracts\Support\Renderable vista de edición
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
     * @return \Illuminate\Http\RedirectResponse users.index
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
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse users.index
     */
    public function destroy(User $user)
    {
        $user->delete();

        return Redirect::route('users.index')
            ->with('success', 'Usuario #' . $user->id . ' eliminado correctamente');
    }
}
