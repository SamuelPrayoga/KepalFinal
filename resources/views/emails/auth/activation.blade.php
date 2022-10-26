@component('mail::message')
# Aktivasi Akun Email Anda

Berikut ini kode OTP akun Anda: <h2><b> {{ $user->token_activation }} </b></h2><br>
Silahkan Masukkan kode OTP tersebut untuk melakukan aktivasi
akun Anda.
<br>
Jangan berikan kode OTP ini kepada siapapun.
<br>
Kode OTP akan kadaluarsa dalam 60 detik.


Salam,<br>
{{ config('app.name') }}
@endcomponent
