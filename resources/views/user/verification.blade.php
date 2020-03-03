@extends('layouts.user_login')

@section('title',"Verification")

@section('css')
@endsection

@section('content')
	<main>
        <div class="activation-section">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-2">
                        <a href="{{ route('login') }}">
                            <img src="{{ asset('dist/assets/img/logo/logo.png') }}" class="img-fluid mb-2">
                        </a>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-12 col-md-5">
                    <a href="{{ route('dashboard') }}">
                        <img src="{{ asset('dist/assets/img/ilustrasi_verifikasi.png') }}" class="img-fluid mb-3">
                    </a>    
                    </div>
                    <div class="col-12 text-center">
                        <h4 class="mb-3">Verifikasi Email</h4>
                        <p>Verifikasi email Anda agar dapat masuk
                            dan menggunakan aplikasi ke Sapaguru.
                        </p>
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-12 col-lg-3 ">
                                    <form method="post" action="{{ route('verification.email.send') }}">@csrf<button class="btn-block btn-primary" type="submit">Verifikasi Email</button></form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

{{--     <h2>Email Belum Terverifikasi</h2>
    <p>Silakan melakukan verifikasi email terlebih dahulu dengan cara mengeklik link yang telah dikirimkan ke emailmu!</p>
    <p>Apabila belum mendapatkan email silakan klik tombol dibawah</p>
    <form method="post">@csrf<button type="submit">kirim ulang</button></form> --}}
@endsection

@section('js')
@endsection