<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <meta name="description" content="Write an awesome description for your new site here. You can edit this line in _config.yml. It will appear in your document head meta (for Google search results) and in your feed.xml site description.">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700,800" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,600,700,800" rel="stylesheet">
    
    <link rel="stylesheet" href="{{ asset('dist/assets/packages/bootstrap/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/assets/packages/owl-carousel/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/assets/packages/owl-carousel/owl.theme.default.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/assets/packages/animate/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/assets/packages/fontawesome/css/fontawesome.css') }}">
    
    <link rel="stylesheet" href="{{ asset('dist/assets/css/theme.css') }}">
    <link rel="canonical" href="http://alfianimanuddin.com/index.html">
    <link rel="icon" href="{{asset('img/logo.png') }}">
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
    @yield('content')
    
    
    <script type="text/javascript" src="{{ asset('dist/assets/packages/bootstrap/jquery.js') }}"></script>
    <script type="text/javascript" src="{{ asset('dist/assets/packages/bootstrap/popper.js') }}"></script>
    <script type="text/javascript" src="{{ asset('dist/assets/packages/bootstrap/bootstrap.js') }}"></script>
    <script type="text/javascript" src="{{ asset('dist/assets/packages/owl-carousel/owl.carousel.js') }}"></script>
    <script type="text/javascript" src="{{ asset('dist/assets/js/theme.js') }}"></script>
    @yield('js')
</body>
</html>