<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>
    <meta name="description" content="BUKOBUKU merupakan salah satu perusahaan  di Indonesia 
    yang berfokus pada layanan berbasis pendidikan
     dan telah memiliki lebih dari 6 juta pengguna serta telah mengelola lebih 
     dari 150.000 guru yang menawarkan jasa di lebih dari 100 bidang pelajaran">
    <meta name="author" content="https://sapaguru.com/">
    <link rel="icon" href="{{asset('img/logo.png') }}">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700,800" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,600,700,800" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('dist/assets/packages/bootstrap/bootstrap.css')}}">
    <link rel="stylesheet" href="{{ asset('dist/assets/packages/owl-carousel/owl.carousel.css')}}">
    <link rel="stylesheet" href="{{ asset('dist/assets/packages/owl-carousel/owl.theme.default.css')}}">
    <link rel="stylesheet" href="{{ asset('dist/assets/packages/select2/select2.css')}}">
    <link rel="stylesheet" href="{{ asset('dist/assets/packages/animate/animate.css')}}">
    <link rel="stylesheet" href="{{ asset('dist/assets/packages/fontawesome/css/fontawesome.css')}}">

    <link rel="stylesheet" href="{{ asset('dist/assets/css/theme.css')}}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/chat.css')}}">
    <link rel="canonical" href="{{ URL('http://alfianimanuddin.com/index.html') }}">

    <style type="text/css">
        li:hover { 
              background-color: #fff;
              max-height: 120px;
            }
        .notify{
            margin-top: -16pt; margin-left: 40pt; 
            background-color: orange; color: white; 
            border: 2px solid orange;
            max-width: 25px;
            border-radius: 25px 25px 25px 25px;
        }
    </style>
    @yield('css')
</head>

<body>
    <div id="preloader">
        <div id="ctn-preloader" class="ctn-preloader">
            <div class="animation-preloader">
                <div class="spinner"></div>
                <div class="txt-loading">
                    <span data-text-preloader="B" class="letters-loading">
                        B
                    </span>
                    <span data-text-preloader="U" class="letters-loading">
                        U
                    </span>
                    <span data-text-preloader="K" class="letters-loading">
                        K
                    </span>
                    <span data-text-preloader="O" class="letters-loading">
                        O
                    </span>
                    <span data-text-preloader="B" class="letters-loading">
                        B
                    </span>
                    <span data-text-preloader="U" class="letters-loading">
                        U
                    </span>
                    <span data-text-preloader="K" class="letters-loading">
                        K
                    </span>
                    <span data-text-preloader="U" class="letters-loading">
                        U
                    </span>
                </div>
                <p class="text-center">Loading</p>
            </div>
            <div class="loader">
                <div class="row">
                    <div class="col-3 loader-section section-left">
                        <div class="bg"></div>
                    </div>
                    <div class="col-3 loader-section section-left">
                        <div class="bg"></div>
                    </div>
                    <div class="col-3 loader-section section-right">
                        <div class="bg"></div>
                    </div>
                    <div class="col-3 loader-section section-right">
                        <div class="bg"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <header class="header box-shadow"{{-- -dashboard box-shadow" style="background-color:#f8f9fa; max-height:95px" --}}>
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand" href="{{route('dashboard')}}">
                    <img src="{{asset('dist/assets/img/logo/logo2.png') }}" srcset="{{ asset('dist/assets/img/logo/logo2.png 2x') }}" alt="logo" style="width:60px;">
                    <img src="{{asset('dist/assets/img/logo/logo2.png') }}" srcset="{{ asset('dist/assets/img/logo/logo2.png 2x') }}" alt="">
                </a>
                <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="menu-toggle">
                        <span class="hamburger">
                            <span></span>
                            <span></span>
                            <span></span>
                        </span>
                        <span class="hamburger-cross">
                            <span></span>
                            <span></span>
                        </span>
                    </span>
                </button>
    
                @include('landing.menu')

            </div>
        </nav>
    </header>
    
    @yield('content')

    <script type="text/javascript" src="{{ asset('dist/assets/packages/bootstrap/jquery.js') }}"></script>
    <script type="text/javascript" src="{{ asset('dist/assets/packages/bootstrap/popper.js') }}"></script>
    <script type="text/javascript" src="{{ asset('dist/assets/packages/bootstrap/bootstrap.js') }}"></script>
    <script type="text/javascript" src="{{ asset('dist/assets/packages/owl-carousel/owl.carousel.js') }}"></script>
    <script type="text/javascript" src="{{ asset('dist/assets/packages/select2/select2.js') }}"></script>
    <script type="text/javascript" src="{{ asset('dist/assets/js/theme.js') }}"></script>
    @yield('js')
</body>

</html>