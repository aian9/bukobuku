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
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-5 p-0">
                        <div class="background">
                            <a href="{{route('dashboard')}}">
                                <img src="{{ asset('dist/assets/img/logo/logo.png') }}" class="float-logo">
                            </a>
                            {{-- <div class="text-feature-area">
                                <h5 class="text-white">
                                    <b>
                                        Dedikasi pada Pelanggan
                                    </b>
                                </h5>                        
                                <p class="text-white">Pelanggan selalu menjadi prioritas utama kami. Sebelum membuat keputusan, kami selalu memikirkan pelanggan, terutama soal apa yang dapat kami lakukan untuk melayani Anda lebih baik lagi.</p>
                            </div> --}}
                        </div>
                    </div>
                    <div class="col-lg-7 p-0">
                        <div class="login-register">
                            <!-- Heading -->
                            <div class="d-lg-none d-md-none d-block pr-5 pl-5 pb-4 pt-0">
                                <img src="{{ asset('dist/assets/img/logo/logo.png') }}" class="img-fluid">
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