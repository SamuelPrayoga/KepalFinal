<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Events\Auth\UserActivationEmail;
use Illuminate\Support\Str;


class UserController extends Controller
{
    public function verification()
    {
        return view('auth.verification');
    }

    public function postVerification(Request $request)
    {
        $user = User::where('token_activation', $request->otp)->first();

        if($user==null){
            return redirect()->back()->with('flash_message_error','OTP Tidak Valid atau Salah, Silahkan Cek Kembali !');
        }else{
            $user->update([
                'isVerified' => true,
                'token_activation' => null,
            ]);
            return redirect('login')->with('flash_message_success','Selamat, Akun Anda berhasil di-Aktivasi !');;
        }
    }

    public function postResend(Request $request)
    {
        $this->validates($request);

        $user = User::where('email', $request->email)->first();

        //send email
        if($user==null){
            return redirect()->back();
        }else{
            $user->token_activation = Str::random(6);
            $user->save();
            event(new UserActivationEmail($user));

            return redirect()->route('verification')->withSuccess('Kode OTP telah dikirimkan ke email, silahkan cek');
        }
    }

    protected function validates(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|exists:users,email'
        ], [
            'email.exists' => 'Email tidak ditemukan, Silahkan cek Kembali'
        ]);
    }
}
