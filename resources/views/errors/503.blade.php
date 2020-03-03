<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Sapaguru - Maintenance</title>
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
    </head>
    
    <style type="text/css">
        .gambar_logo{
            width: 21%;
            padding-bottom: 50px;
        }

        .pas_tengah{
            text-align: center;
            position: fixed;
            width: 80%;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-weight: 500;
            font-size: 30px;
        }

        @media (max-width: 991.98px) {
            .gambar_logo{
                width: 30%;
            }

            .pas_tengah{
                font-size: 23px;
            }
        }

        @media (max-width: 767.98px) {
            .gambar_logo{
                width: 50%;
            }

            .pas_tengah{
                font-size: 15px;
            }
        }
    </style>

    <body>
        <div class="pas_tengah">
            <img src="{{ asset('img/logo.png') }}" class="gambar_logo"/>
            <br/>
            <p>Untuk kenyamanan Anda, kami sedang melakukan maintenance. <i class="far fa-frown-open"></i></p>
            <p>Kami akan segera kembali.</p>
        </div>
    </body>
</html>