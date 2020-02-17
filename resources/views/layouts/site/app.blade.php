<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name') }} | B2C Marketplace</title>


        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('bower_components/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
        <link href="{{ asset('js/owl-carousel/owl.carousel.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('js/changethewords/animate.changethewords.css') }}">

        <link href="{{ asset('main/dirfront.css') }}" rel="stylesheet">
        <link href="{{ asset('main/dir-responsive.css') }}" rel="stylesheet">
        <link href="{{ asset('main/colors.css') }}" rel="stylesheet">
        <link href="{{ asset('main/fonts.css') }}" rel="stylesheet">
    </head>
    <body>
        <div id="container">
            @include('layouts.site.header')
            <div id="content">
                <div id="flash-msg" style="display: none" class="alert alert-success"></div>

                    @yield('content')
            </div>
        </div>

        @include('layouts.site.footer')
        <!-- Scripts -->
        
        <script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
        <script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}" defer></script>
        <script src="{{ asset('js/changethewords/jquery.changethewords.js') }}" defer></script>


        <script type="text/javascript">
            $(function() {
              $("#changethewords").changeWords({
                time: 2000,
                animate: "pulse",
                selector: "span",
                repeat: true // false
              });
            });
        </script>
        
        @yield('page-js-script')
    </body>
</html>
