@extends('layouts.user_login')

@section('title',"Lupa Password")

@section('css')
@endsection

@section('content')
        <main>
        <div class="login-register-section">
            <div class="container-fluid p-0">
                <div class="row">
                    <div class="col-lg-5 p-0">
                        <div class="background">
                            <a href="{{route('dashboard')}}">
                                <img src="{{ asset('dist/assets/img/logo/logo.png') }}" class="float-logo">
                            </a>
                            <div class="text-feature-area" style="margin-top:100px;">
                                <h5 class="text-white">
                                    <b>
                                        Belum Punya Akun?
                                    </b>
                                </h5>
                                {{-- <p class="text-white">Di Kredit Impian kami percaya bahwa pelanggan harus menjadi prioritas utama. Kami ada untuk memberikan yang terbaik bagi Anda.</p> --}}
                                <a href="{{route('register')}}" class="btn btn-outline-light">
                                    <b>Daftar Sekarang</b>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7 p-0">
                        <div class="login-register">
                            <!-- Heading -->
                            <div class="d-lg-none d-md-none d-block pr-5 pl-5 pb-4 pt-0">
                                <img src="{{ asset('dist/assets/img/logo/logo.png') }}" class="img-fluid">
                            </div>

                            <h1>KONFIRMASI LUPA PASSWORD</h1>
                            <!-- Form -->
                            <form action="{{ route('forgotten.confirm.act') }}" method="post">
                                @if (session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif
                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                @csrf

                                <!-- name input -->
                                <div class="input-block">
                                    <input type="hidden" name="iduser" value="{{ $data }}">
                                    
                                    <input type="password" placeholder="Password" class="form-control input" name="password" id="password"  required />
                                    <span class="text-danger">{{ $errors->first('password') }}</span>

                                    <input type="password" placeholder="Ketik Ulang Password" class="form-control input" name="password_confirmation" id="password_confirmation"  required />
                                    <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                </div>
                                <!-- sign in button -->
                                <button type="submit" class="btn btn-primary btn-block" style="min-height: 45px">
                                    <b>Ganti Password</b>
                                </button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </main>
@endsection

@section('js')
@endsection
