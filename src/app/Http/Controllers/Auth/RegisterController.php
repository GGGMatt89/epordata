<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    // protected $redirectTo = '/home';
    protected $redirectTo = '/db_home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('guest');
        $this->middleware('checkrole:Admin');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $validatedData = Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'auth_level' => ['required', Rule::in(['User', 'Admin', 'Operator', 'Guest'])]
        ]);
        return $validatedData;
    }

    public function showRegistrationForm()
    {
        $auth_levels = ['User', 'Admin', 'Operator', 'Guest'];
        return view('auth.register', ['auth_levels' => $auth_levels]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'auth_level' => $data['auth_level']
        ]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        Profile::create([
            'first_name' => $user->name,
            'last_name' => $user->name,
            'birth_date' => null,
            'tax_code' => null,
            'res_address' => null,
            'res_city' => null,
            'post_code' => null,
            'mobile_phone' => null,
            'area' => null,
            'user_id' => $user->id
        ]);
        return redirect()->route('db_home')->with('success_create', 'Salvato!')->with('alert_text', 'Nuovo utente inserito!');
        // $this->registered($request, $user)
            // ?: redirect($this->redirectPath());
    }
}
