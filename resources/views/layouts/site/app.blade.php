<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="theme-color" content="#18ab9b">

        <title>@yield('title') {{ config('app.name') }} | B2C Marketplace</title>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('bower_components/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
        <link href="{{ asset('js/owl-carousel/owl.carousel.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('js/changethewords/animate.changethewords.css') }}">

        <link href="{{ asset('main/dirfront.css?var=20202803') }}" rel="stylesheet">
        <link href="{{ asset('main/dir-responsive.css?var=20202803') }}" rel="stylesheet">
        <link href="{{ asset('main/colors.css') }}" rel="stylesheet">
        <link href="{{ asset('main/fonts.css') }}" rel="stylesheet">


        @if($_SERVER['HTTP_HOST'] == 'cardbiz.in')
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-166868228-1"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());

          gtag('config', 'UA-166868228-1');
        </script>
        @endif
        

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
        @include('partials.login')

        <!-- Scripts -->
        
        <script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
        <script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}" defer></script>
        <script src="{{ asset('js/changethewords/jquery.changethewords.js') }}" defer></script>
        <script src="{{ asset('js/jquery.mask.min.js') }}" defer></script>


        <script type="text/javascript">
            $(function() {
              $("#changethewords").changeWords({
                time: 2000,
                animate: "pulse",
                selector: "span",
                repeat: true // false
              });

            $('[data-toggle="slide-collapse"]').on('click', function() {
                $navMenuCont = $($(this).data('target'));
                $navMenuCont.animate({
                'width': 'toggle'
                }, 350);
                $(".menu-overlay").fadeIn(500);
            });
            
            $(".menu-overlay").click(function(event) {
                $(".navbar-toggle").trigger("click");
                $(".menu-overlay").fadeOut(500);
            });

            

$('.add-to-contact').on('click', function () {
    var _id = $(this).data('id');
    var _this = $(this);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    jQuery.ajax({
        url: "{{ url('add-to-contact') }}",
        method: 'post',
        data: {id: _id},
        success: function (result) {
            //console.log(result);
            if(result == 0){
                _this.html('<i class="fa fa-heart-o"></i> Add to My Contacts');
            }else{
                _this.html('<i class="fa fa-heart"></i> Unlink My Contacts');
            }
        }
    });
});            

            });
            </script>

        @if($errors->has('email') || $errors->has('password'))
            <script type="text/javascript">
            $(function() {
                $('#loginModal').modal({
                    show: true
                });
            });
            </script>
        @endif

        
        @yield('page-js-script')
    </body>
</html>
