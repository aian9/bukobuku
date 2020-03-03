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
                        <h4 class="mb-3">Selamat!</h4>
                        <p>Akun Anda telah diaktivasi melalui email. Klik tombol dibawah ini untuk masuk.</p>
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-12 col-lg-3">
                                    @if(Auth::guard()->check())
								        <a class="btn-block btn-primary" href="{{route('user.dashboard.index')}}">Dashboard</a>
								    @else
								        <a href="{{route('login')}}">Login</a>
								    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('js')
@endsection