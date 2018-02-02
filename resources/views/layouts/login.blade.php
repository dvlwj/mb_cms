<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/loginscreen.css') }}" rel="stylesheet">
    <link href="{{ asset('css/toastr.min.css') }}" rel="stylesheet">
    @yield('css')
    <style type="text/css">
        @font-face {
            font-family: 'Nunito';
            src: url('{{ asset('/fonts/Nunito-Regular.ttf') }}');
        }
        @font-face {
            font-family: 'Poiret One';
            src: url('{{ asset('/fonts/PoiretOne-Regular.ttf') }}');
        }
    </style>
    <script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script>
        $(document).ready(function(){
            var images = ['../images/background/1.jpg', '../images/background/2.jpg', '../images/background/3.jpg', '../images/background/4.jpg', '../images/background/5.jpg','../images/background/6.jpg'];
            $('body').css({
                'background-image': 'url("img/' + images[Math.floor(Math.random() * images.length)] + '")'
            });
        })
    </script>
</head>
<body>
    <div id="app">
        @yield('content')
    </div>
    @yield('script')
</body>
</html>
