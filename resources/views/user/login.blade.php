@extends('layouts.user_login')

@section('title',"Login")

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
                            <div class="d-lg-none d-md-none d-block pr-5 pl-5 pb-4 pt-0 text-center">
                                <img src="{{ asset('dist/assets/img/logo/logo.png') }}" class="img-fluid" style="width: 100px;">
                            </div>
                            
                            <h1>MASUK</h1>
                            <!-- Form -->
                            <form action="{{route('login.act')}}" method="post" enctype="multipart/form-data">
                                @if (session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif
                                @if ($errors->has('username'))
                                    <div class="alert alert-danger">
                                        {{ $errors->first() }}
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
                                    <input type="text" placeholder="Email/Username" class="form-control input" id="username"  name="username"/>
                                </div>
                                <!-- password input -->
                                <div class="input-block">
                                    <input type="password" placeholder="Password" class="form-control input" id="password" name="password" />
                                </div>
                                <!-- sign in button -->
                                <button type="submit" class="btn btn-primary btn-block" style="min-height: 45px">
                                    <b>Masuk</b>
                                </button>
                                <div class="forgot-register my-2 mt-4 d-flex justify-content-between align-items-center">
                                    <a href="{{ route('forgotten') }}" id="to-recover" class="text-primary">
                                        Lupa Password ?
                                    </a>
                                    <p class="mb-0">
                                        Tidak punya akun ? <a class="text-primary" href="{{route('register')}}">Daftar sekarang</a>
                                    </p>
                                </div>
                                <br>
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