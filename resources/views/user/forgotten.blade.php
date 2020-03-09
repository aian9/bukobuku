@extends('layouts.user_login')

@section('title',"Lupa Password")

@section('css')
@endsection

@section('content')
<main>
    <div class="login-register-section">
        <div class="container-fluid p-0">
            <div class="row"> 
                <div class="col-lg-5 p-0 d-md-none d-lg-block">
                    <div class="background" style="background: #7f7f7f;">
                        <img src="{{ asset('dist/assets/img/background-login.jpg') }}" class="img-fluid">
                        {{--  <a href="{{route('dashboard')}}" class="float-logo ">
                            <img src="{{ asset('dist/assets/img/logo/logo.png') }}" style="width:30%;" class="img img-fluid">
                        </a>  --}}
                        {{-- <div class="text-feature-area" style="margin-top:100px;">
                            <h5 class="text-white">
                                <b>
                                    Belum Punya Akun?
                                </b>
                            </h5>
                            <p class="text-white">Di Kredit Impian kami percaya bahwa pelanggan harus menjadi prioritas utama. Kami ada untuk memberikan yang terbaik bagi Anda.</p> 
                            <a href="{{route('register')}}" class="btn btn-outline-light">
                                <b>Daftar Sekarang</b>
                            </a>
                        </div> --}}
                    </div>
                </div>
                <div class="col-lg-7 p-0">
    <div class="login-register">
        <!-- Heading -->
        <div class="d-block pr-5 pl-5 pb-4 pt-0 text-center">
            <img src="{{ asset('dist/assets/img/logo/logo.png') }}" class="img-fluid" style="width: 100px;">
        </div>

        <h1>LUPA PASSWORD</h1>
        <!-- Form -->
        <form action="{{ route('forgotten.sendemail') }}" method="post">

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
                <input type="email" placeholder="Ketik Email Anda" class="form-control input" id="email"  name="email"/>
            </div>
            <!-- sign in button -->
            <button type="submit" class="btn btn-primary btn-block" style="min-height: 45px">
                <b>Kirim</b>
            </button>
            <div class="my-2 mt-4 d-flex justify-content-between align-items-center">
                <a href="{{ route('login') }}" class="text-primary">
                    Kembali ke Login
                </a>
            </div>
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
