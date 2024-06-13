<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public $levels = ['User', 'Admin', 'Operator', 'Guest'];

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('db_views.user.index', [
            'users' => User::all()->sortBy('id')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //     //
    // }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('db_views.user.edit', ['user' => $user, 'levels' => $this->levels]);
    }

    /**
     * Show the form for editing the specified resource with limited access.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editLimit(User $user)
    {
        return view('db_views.user.editLimit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $data = request()->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user)],
            'auth_level' => ['required', 'string', Rule::in($this->levels)],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        $validatedAttributes = [
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'auth_level' => $data['auth_level']
        ];
        $user->update($validatedAttributes);
        return redirect()->route('user.index')->with('success_create', 'Salvato!')->with('alert_text', $user->name . ' modificato!');
    }

    public function updateLimit(Request $request, User $user)
    {
        $data = request()->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user)],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        $validatedAttributes = [
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ];
        $user->update($validatedAttributes);
        $profile = $user->profile;
        return redirect()->route('profile.show', ['profile' => $profile])->with('success_create', 'Salvato!')->with('alert_text', $user->name . ' modificato!');
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
        return redirect()->route('user.index')->with('success_create', 'Eliminato!')->with('alert_text', 'Utente rimosso!');
        ;
    }
}
