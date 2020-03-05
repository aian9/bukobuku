@extends('landing.dashboard')
	
@section('title',"BUKOBUKU - Belajar Cepat, Belajar Hemat")

@section('css')
    <style>
        input{display: block}
        @media only screen and (min-width: 576px) and (max-width: 767px) {
            .banner-area {
                height: 800px;
            }
        }
        @media only screen and (min-width: 500px) and (max-width: 576px) {
            .banner-area {
                height: 850px;
            }
        }
        @media only screen and (min-width: 400px) and (max-width: 500px) {
            .banner-area {
                height: 750px;
            }
        }
    </style>
@endsection

@php
    /** @var \Illuminate\Support\MessageBag $errors */
@endphp
@section('content')
	<main>
        <div class="banner-area">
            <div class="welcome-area">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-md-5 col-lg-6 col-sm-12 col-xs-12" style="margin-top:10px;">
                            <img src="{{ asset('dist/assets/img/banner-image.png') }}" class="img-fluid px-3">
                        </div>
                        <div class="col-md-7 col-lg-6 col-sm-12 col-xs-12">
                            <div class="welcome-text">
                                <h1>
                                    BUKOBUKU
                                </h1>
                                <p>
                                    @if(!Auth::user())
                                    Pencarian guru privat sesuai tipemu semakin mudah disini. Jadilah guru dan murid terbaik sekarang.
                                    @else
                                        @if(auth()->user()['tipe_akun']=='2')
                                        Mengajarlah dari hati, rileks dan jadikan muridmu seperti teman belajarmu.
                                        <br/><br/> Tips : Agar lebih keren isi profilmu selengkap mungkin.
                                        @elseif(auth()->user()['tipe_akun']=='1')
                                        Cari guru sesuai keingiananmu, pesan dan guru segera mengkonfirmasi.
                                        <br/><br/> Tips : Pilih sesuai jadwal yang kosong ya.
                                        @endif
                                    @endif
                                </p>
                                @if(!Auth::user())
                                <a href="{{route('register')}}" class="btn btn-primary lg" style="margin-top:20px;">
                                    Daftar Sekarang
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div style="height:80px; background-color:orange; padding-top:15px">         
            
        </div>

        @if(!Auth::user())
        <section class="pb-0">
            <div class="text-center">
                <div class="title text-center">
                    <h3>
                        Bergabung Dengan Kami
                    </h3>
                </div>
                <p>
                    Belajar dan mengajari adalah hal yang perlu dilakukan oleh semua orang untuk mengembangkan diri menjadi lebih baik. 
                </p>
                <p>
                    BUKOBUKU hadir bersama guru, pelajar, dan masyarakat untuk membantu pendidikan yang lebih maju dan merata dengan menghadirkan teknologi.
                </p>
                <p>
                    Bersama BUKOBUKU kami mengajak seluruh elemen terdidik di Indonesia, melakukan sharing ilmu dan pengalaman, kami meyakini pendidikan akan lebih cerah dan indah ketika setaip orang mau berbagi pengetahuan, tanpa hirarki yang mengikat, dan sebagai seorang teman bagi pelajar.
                </p>
                <p>
                    Menjadi pengajar di BUKOBUKU artinya menjadi pahlawan kemajuan Indonesia melalui generasi yang lebih baik.
                </p>
                @if(!Auth::user())
                <center>
                    <a href="{{ route('registerguru') }}" class="btn btn-primary lg">
                        Daftar Sebagai Guru
                    </a>
                </center>
                @endif
            </div>
        </section> <br><br><br>
        @endif
        
        @include('landing.footer')
    </main>
@endsection

@section('js')

@endsection