<?php

namespace App\Http\Controllers\Auth;

use App\Events\Auth\UserActivationEmail;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Helpers\HashSalt;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


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

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],

        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $salt = "a1Bz20ydqelm8m1wql";
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'role' => 'customer',
            //'password' => hash('sha256','password'),
            'password' => Hash::make($data['password']),
            //'password' => Hash::make(hash('sha256', $salt.$data['password'])),
            //'password' => HashSalt::hash_salt($data['password']),
            'token_activation' => random_int(100000, 999999),
            //'salt'=>'nullable',
            'isVerified' => false,

            //add salt in password

        ]);
        //$validateData['password'] = HashSalt::hash_salt($validateData['password']);
        //$validateData['password'].$validateData['salt'];
        //$randomNumber = random_int(100000, 999999);
        //Str::random(6),
        //$password = HashSalt::hash_salt($password['password']);
    }





    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        event(new UserActivationEmail($user));

        $this->guard()->logout();

        return redirect()->route('verification')->withSuccess('Registrasi Berhasil, Silahkan cek Email Anda');
    }
}
