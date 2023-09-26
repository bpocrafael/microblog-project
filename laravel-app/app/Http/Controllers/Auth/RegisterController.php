<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\UsersInformation;
use App\Http\Requests\CreateUserRequest;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;


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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    public function register(CreateUserRequest $request)
    {   
        $validatedData = $request->validated();

        $user =  User::create([
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'username' => $validatedData['username'],
        ]);

        $user->users_information()->create([
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
        ]);

        event(new Registered($user));

        Auth::login($user);

        return view('auth.verify');
    }
}
