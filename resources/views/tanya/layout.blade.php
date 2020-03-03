<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>
    <meta name="description" content="Sapaguru merupakan salah satu perusahaan  di Indonesia 
    yang berfokus pada layanan berbasis pendidikan
     dan telah memiliki lebih dari 6 juta pengguna serta telah mengelola lebih 
     dari 150.000 guru yang menawarkan jasa di lebih dari 100 bidang pelajaran">
    <meta name="author" content="https://sapaguru.com/">
    <link rel="icon" href="{{asset('img/logo.png') }}">
    
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700,800" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('admin/assets/packages/bootstrap/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/packages/owl-carousel/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/packages/owl-carousel/owl.theme.default.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/packages/animate/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/packages/fontawesome/css/fontawesome.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <link rel="stylesheet" href="{{ asset('admin/assets/css/theme.css') }}">
    <link rel="canonical" href="http://alfianimanuddin.com/index.html">
    @yield('css')

    <style type="text/css">
        .dropdown-account li:hover { 
          background-color: #fbf6ea;
          border-radius: 25px;
        }
        .dropdown-menu li {
          padding: 5px;
          list-style-type:none;
          margin-left: 10px;
          margin-right: 5px;
        }
        .dropdown-menu li:hover {
          padding: 5px;
          list-style-type:none;
          margin-left: 10px;
          margin-right: 5px; 
          background-color: #fbf6ea;
          border-radius: 10px;
        }
        .dropdown-menu li a{
          text-decoration: none;
        }

        @import url(https://fonts.googleapis.com/css?family=Roboto:400,100,900);

        html,
        body {
          -moz-box-sizing: border-box;
               box-sizing: border-box;
          height: 100%;
          width: 100%; 
          background: #FFF;
          font-family: 'Roboto', sans-serif;
          font-weight: 400;
        }
         
        .wrapper {
          display: table;
          height: 100%;
          width: 100%;
        }

        .container-fostrap {
          display: table-cell;
          padding: 1em;
          text-align: center;
          vertical-align: middle;
        }
        .fostrap-logo {
          width: 100px;
          margin-bottom:15px
        }
        h1.heading {
          color: #fff;
          font-size: 1.15em;
          font-weight: 900;
          margin: 0 0 0.5em;
          color: #505050;
        }
        @media (min-width: 450px) {
          h1.heading {
            font-size: 3.55em;
          }
        }
        @media (min-width: 760px) {
          h1.heading {
            font-size: 3.05em;
          }
        }
        @media (min-width: 900px) {
          h1.heading {
            font-size: 3.25em;
            margin: 0 0 0.3em;
          }
        } 
        .card {
          display: block; 
            margin-bottom: 20px;
            line-height: 1.42857143;
            background-color: #fff;
            border-radius: 2px;
            box-shadow: 0 2px 5px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12); 
            transition: box-shadow .25s; 
        }
        .card:hover {
          box-shadow: 0 8px 17px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
        }
        .img-card {
          width: 100%;
          height:200px;
          border-top-left-radius:2px;
          border-top-right-radius:2px;
          display:block;
            overflow: hidden;
        }
        .img-card img{
          width: 100%;
          height: 200px;
          object-fit:cover; 
          transition: all .25s ease;
        } 
        .card-content {
          padding:15px;
          text-align:left;
        }
        .card-title {
          margin-top:0px;
          font-weight: 700;
          font-size: 1.65em;
        }
        .card-title a {
          color: #000;
          text-decoration: none !important;
        }
        .card-read-more {
          border-top: 1px solid #D4D4D4;
          margin-bottom: 10px;
        }
        .card-read-more button {
          text-decoration: none !important;
          padding:10px;
          margin-top: 10px;
          text-transform: uppercase
        }
</style>
</head>

<body>
    <header class="header">
        <nav class="navbar top-navbar navbar-expand-md navbar-light">
            <div class="navbar-collapse d-flex justify-content-between align-items-center">
                <!-- toggle and nav items -->
                <ul class="navbar-nav navbar-nav-toggle mt-md-0 pl-3 d-flex align-items-center">
                    <button id="btn-toggle" class="btn btn-transparent mr-3">
                        <i class="fa fa-bars" style="font-size: 1.2rem"></i>
                    </button>
                    @if(Route::currentRouteName()=="anya.dashboard")
                    <div class="search-bar">
                        <input type="text" class="form-searchbar" name="searchbar" id="searchbar" placeholder="search">
                        <a class="btn btn-transparent p-0" href="#">
                            <i class="fas fa-search"></i>
                        </a>
                    </div>
                    <li class="nav-item">
                        <a class="nav-link nav-toggler d-md-block d-lg-none d-block text-muted" href="javascript:void(0)"><i class="fas fa-bars"></i></a>
                    </li>
                    @endif
                </ul>
                    
                <ul class="navbar-nav mr-auto" style="margin-left: 15px; background-color: orange; max-width: 120px; margin-top: -7px; margin-bottom: -7px; color: #fff">
                  <li class="active">
                    <a class="nav-link" href="#" style="color:#fff;margin-left: 8px; font-size: 11pt ">Saldo : <br><b>200000000</b></a>
                  </li>
                </ul>

                <a class="navbar-brand d-lg-none d-md-none d-none" id="navbar" href="index.html">
                    <img src="{{ asset('admin/assets/img/logo/logo-small.png') }}" alt="logo" class="img-rectangle" />
                </a>

                <!-- User profile -->
                <ul class="navbar-nav my-lg-0 pr-3 text-white d-flex justify-content-end align-items-center">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" id="profile-dropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-user-circle"></i>
                            <p class="mb-0" style="margin-left: 5px">{{ \Auth::user()->username }}</p>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right py-0">
                            <ul class="dropdown-account">
                                <li>
                                    <a href="{{route('logout')}}" class="nav-link">
                                        Logout
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    
                </ul>
            </div>
        </nav>
    </header>
    @include('tanya.menu')
    
    @yield('content')

    
    <script type="text/javascript" src="{{ asset('admin/assets/packages/bootstrap/jquery.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin/assets/packages/bootstrap/popper.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin/assets/packages/bootstrap/bootstrap.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin/assets/packages/owl-carousel/owl.carousel.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin/assets/packages/fancybox/fancybox.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin/assets/packages/select2/select2.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin/assets/js/theme.js') }}"></script>
    @yield('js')
</body>

</html>