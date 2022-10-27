@component('mail::message')
# Aktivasi Akun Email

Halo <b>{{ $user->name }},</b>

Masukkan kode berikut untuk melakukan verifikasi pertanyaan keamanan.

<h1><b> {{ $user->token_activation }} </b></h1><br>
Silahkan Masukkan kode OTP tersebut untuk melakukan aktivasi
akun Anda.
<br>
Kode di atas hanya berlaku 5 menit. Mohon jangan sebarkan kode ini ke siapapun, termasuk pihak yang mengatasnamakan GO-LAPAK.
<br>
E-mail ini dibuat otomatis, mohon tidak membalas. Jika butuh bantuan, silakan hubungi GO-LAPAK Care.<br>

Salam,<br>
{{ config('app.name') }}
@endcomponent
