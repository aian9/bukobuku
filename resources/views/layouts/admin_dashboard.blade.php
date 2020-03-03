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
                    <!-- <div class="search-bar">
                        <input type="text" class="form-searchbar" name="searchbar" id="searchbar" placeholder="search">
                        <a class="btn btn-transparent p-0" href="#">
                            <i class="fas fa-search"></i>
                        </a>
                    </div> -->
                    <!-- This is  -->
                    <!-- <li class="nav-item">
                        <a class="nav-link nav-toggler d-md-block d-lg-none d-block text-muted" href="javascript:void(0)"><i class="fas fa-bars"></i></a>
                    </li> -->
                </ul>

                <a class="navbar-brand d-lg-none d-md-none d-none" id="navbar" href="index.html">
                    <img src="{{ asset('admin/assets/img/logo/logo-small.png') }}" alt="logo" class="img-rectangle" />
                </a>

                <!-- User profile -->
                <ul class="navbar-nav my-lg-0 pr-3 text-white d-flex justify-content-end align-items-center">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" id="notification" onclick="readNotif()" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="far fa-bell" aria-hidden="true" style="font-size: 1.25rem;">
                                @if(isset($total[0]) && count($total[0])>1) 
                                <div class="notification">
                                   {{ count($total) }}
                                </div>
                                @endif
                            </i>
                        </a>
                        
                        <div class="dropdown-menu dropdown-menu-right py-0">
                            <ul class="dropdown-notification">
                                @foreach($notif as $key => $val)
                                <li>
                                    <a href="{{ url("admin/pengaduan/notif/".$val["id"]) }}">
                                        @if($val["status"]==0)
                                        <div class="notification-in" style="background-color: #f6e6d1">
                                        @else
                                        <div class="notification-in">
                                        @endif
                                            @if(file_exists(asset('img/uploads/profile')."/".$val["id_user"].".jpg"))
                                            <img src="{{ asset('img/uploads/profile')."/".$val["id_user"].".jpg" }}" class="teacher-image rounded-circle mr-3" width="50px" height="50px" style="border: 5px solid #DDD; margin:5pt">
                                            @else
                                            <img src="{{ asset('img/')."/"."profile_laki.jpg" }}" class="teacher-image rounded-circle mr-3" width="50px" height="50px" style="border: 5px solid #DDD; margin-left: 5px;">
                                            @endif
                                            <span>
                                                <strong>
                                                    <p class="mb-0">
                                                        {{ substr($val["ket"], 0,100) }}
                                                    </p>
                                                </strong>
                                                <small class="text-muted">
                                                    <i class="far fa-clock"></i>
                                                        {{ $val["created_at"] }}
                                                </small>
                                            </span>
                                        </div>
                                    </a>
                                </li>
                                @endforeach

                                <li class="notification-footer">
                                    <a href="#">
                                        <div class="notification-in">
                                            <span class="notification-in-footer">
                                                <p class="mb-0">
                                                    Lihat Semua
                                                </p>
                                            </span>
                                        </div>
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" id="profile-dropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-user-circle"></i>
                            <p class="mb-0" style="margin-left: 5px">{{ \Auth::user()->username }}</p>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right py-0">
                            <ul class="dropdown-account">
                                {{-- <li>
                                    <a href="{{route('admin.dashboard')}}">
                                        <i class="fa fa-cogs"></i> Setting
                                    </a>
                                </li> --}}
                                <li>
                                    <a href="{{route('logout')}}" class="nav-link">
                                        Logout
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <!-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" id="menu-setting" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-ellipsis-h" aria-hidden="true"></i>
                        </a>
                    </li> -->
                </ul>
            </div>
        </nav>
    </header>
    @include('layouts.menu')

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