@extends('landing.dashboard')
    
@section('title',"Sapaguru - Education Technology Startup")

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
        {{-- <div class="jumbotron jumbotron-fluid">
            <video autoplay muted loop poster="https://dummyimage.com/900x400/000/fff">    
                <source src="" data-src="dist/assets/media/video.mp4" type="video/mp4">
                <source src="" data-src="dist/assets/media/video.webm" type="video/webm">
                <source src="" data-src="dist/assets/media/video.ogv" type="video/ogg">
            </video>            
            <div class="container text-white">
                <h1>
                    Tentang Kami
                </h1>
            </div>
        </div> --}}
        <section class="pb-0">
            <div class="text-center">
                <div class="title text-center" style="padding-top: 95px;">
                    <h3>
                        Tentang Sapaguru
                    </h3>
                </div>
                <p>
                    Sapaguru adalah perusahaan teknologi dalam bidang pendidikan, kami memiliki layanan dengan jangkauan seluruh Indonesia, yang berpusat di Surabaya Jawa Timur. Didirikan oleh mahasiswa Institut Teknologi Sepuluh Nopember untuk membantu orang tua mencari guru privat paling tepat untuk anaknya, sekaligus membantu mahasiswa/guru privat mendapatkan penghasilan tambahan dengan menjadi guru privat di Sapaguru.
                </p>
                <p>
                    Sapaguru berkomitmen akan terus melakukan perbaikan sistem dan layanan demi kenyamanan belajar siswa Indonesia. Sapaguru selalu mengedepankan pemahaman siswa dalam belajar dibandingkan hanya sekadar menghafal dengan penyelesaian cepat, karena kami meyakini pembekalan pemahaman akan lebih penting untuk jenjang yang lebih tinggi dibandingkan dengan metode menghafal instan namun melupakan pola pikir dasar dalam belajar.
                </p>
            </div>
        </section>
        {{-- <section class="team">
            <div class="container">
                <div class="title text-center">
                    <h3>
                        Tim Sapaguru
                    </h3>
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugiat adipisci iure omnis quia molestiae similique est!
                    </p>
                </div>
        
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <figure>
                            <div class="img">
                                <img src="dist/assets/img/team_01.jpg" alt="">
                            </div>
                            <figcaption>
                                <a href="#">Alfian Imanuddin</a>
                                <h5>Web Designer</h5>
                            </figcaption>
                            <div class="overlay">
                                <figcaption>
                                    <ul>
                                        <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                        <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fab fa-vimeo-v"></i></a></li>
                                        <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                    </ul>
                                    <div class="line"></div>
                                    <a href="#">Alfian Imanuddin</a>
                                    <h5>Web Designer</h5>
                                </figcaption>
                            </div>
                        </figure>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <figure>
                            <div class="img">
                                <img src="dist/assets/img/team_02.jpg" alt="">
                            </div>
                            <figcaption>
                                <a href="#">Alfian Imanuddin</a>
                                <h5>UI/UX Designer</h5>
                            </figcaption>
                            <div class="overlay">
                                <figcaption>
                                    <ul>
                                        <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                        <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fab fa-vimeo-v"></i></a></li>
                                        <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                    </ul>
                                    <div class="line"></div>
                                    <a href="#">Alfian Imanuddin</a>
                                    <h5>UI/UX Designer</h5>
                                </figcaption>
                            </div>
                        </figure>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <figure>
                            <div class="img">
                                <img src="dist/assets/img/team_03.jpg" alt="">
                            </div>
                            <figcaption>
                                <a href="#">Dylan Meringue</a>
                                <h5>Web Designer</h5>
                            </figcaption>
                            <div class="overlay">
                                <figcaption>
                                    <ul>
                                        <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                        <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fab fa-vimeo-v"></i></a></li>
                                        <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                    </ul>
                                    <div class="line"></div>
                                    <a href="#">Dylan Meringue</a>
                                    <h5>Web Designer</h5>
                                </figcaption>
                            </div>
                        </figure>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <figure>
                            <div class="img">
                                <img src="dist/assets/img/team_04.jpg" alt="">
                            </div>
                            <figcaption>
                                <a href="#">Bailey Wonger</a>
                                <h5>Marketer</h5>
                            </figcaption>
                            <div class="overlay">
                                <figcaption>
                                    <ul>
                                        <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                        <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fab fa-vimeo-v"></i></a></li>
                                        <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                    </ul>
                                    <div class="line"></div>
                                    <a href="#">Bailey Wonger</a>
                                    <h5>Marketer</h5>
                                </figcaption>
                            </div>
                        </figure>
                    </div>
                </div>
            </div>
        </section> --}}

        @include('landing.footer')
    </main>
@endsection

@section('js')
@endsection