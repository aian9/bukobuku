@extends('layouts.user_login')

@section('title',"Register")

@section('css')
    <style>
        input{display: block}
    </style>
@endsection

@php
    /** @var \Illuminate\Support\MessageBag $errors */
@endphp
@section('content')
<main>
    <div class="login-register-section">
        <div class="container-fluid p-0">
            <div class="row"> 
                <div class="col-lg-5 p-0 d-md-none d-lg-block">
                    <div class="background" style="background: #7f7f7f;">
                        <img src="{{ asset('dist/assets/img/background-login.jpg') }}" class="img-fluid">
                        {{-- <a href="{{route('dashboard')}}" class="float-logo ">
                            <img src="{{ asset('dist/assets/img/logo/logo.png') }}" style="width:30%;" class="img img-fluid">
                        </a> --}}
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
        @if ($tipe==1)
            <h1>DAFTAR</h1>
        @else
            <h1>DAFTAR GURU</h1>
        @endif
        
        <!-- Form -->

        <form action="{{ route('register.act') }}" method="post">
            @csrf
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
            <div class="input-block">
                <input type="text" placeholder="Username" value="" class="form-control input" name="username" data-input="username" required />
                <span class="text-danger">{{ $errors->first('username') }}</span>
            </div>
            <div class="input-block">
                <input type="text" placeholder="Email" class="form-control input" name="email"  value="" required/>
                <span class="text-danger">{{ $errors->first('email') }}</span>
            </div>
            <div class="input-block">
                <input type="password" placeholder="Password" class="form-control input" name="password" id="password"  required />
                <span class="text-danger">{{ $errors->first('password') }}</span>
            </div>

            <div class="input-block">
                <input type="password" placeholder="Ketik Ulang Password" class="form-control input" name="password_confirmation" id="password_confirmation"  required />
                <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
            </div>
            
            <div class="input-block">
                <select class="form-control" name="type" id="type">
                    @if ($tipe==1)
                        <option value="1">Murid</option>
                    @else
                        <option value="2">Guru</option>
                    @endif
                </select>
                <span class="text-danger">{{ $errors->first('type') }}</span>
            </div><br>

            <button type="submit" class="btn btn-primary btn-block" style="min-height: 45px ">
                <b>Daftar</b>
            </button>

            <div class="mt-3 d-flex center-content-end">
                <p>Sudah punya akun ? Masuk dengan klik <a class="text-primary" href="{{route('login')}}">disini</a></p>
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

<script type="text/javascript">
    $("#type").hide();
</script>

@endsection