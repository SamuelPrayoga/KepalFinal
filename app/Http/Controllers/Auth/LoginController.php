<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Validator;
use App\Listeners\Auth\SendActivationEmail;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * other way to redirect web page
     */
    protected function redirectTo()
    {
        if (auth()->user()->role == 'admin') {
            return RouteServiceProvider::ADMIN;
        }

        return RouteServiceProvider::ROOT;
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function validateLogin(Request $request)
    {
        //$salt = "a1Bz20ydqelm8m1wql";
        //$input = $request->all();
        $request->validate([
            $this->username() => [
                'required', 'string',
                Rule::exists('users')->where(function ($query) {
                    $query->where('isVerified', true);
                })
            ],
            'password' => 'required|string',
            //'password' => hash('sha256','password'),
            //'password' => Hash::make($request->password),
            //'password' => Hash::make(hash('sha256','password')),
        ], [
            $this->username(). '.exist' => 'Email Anda Belum Aktif, Silahkan Aktivasi Terlebih dahulu'
        ]);
    }
}
