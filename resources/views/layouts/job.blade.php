<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Jobs Skoogle</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Amatic+SC:400,700|Work+Sans:300,400,700" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('public/fonts/icomoon/style.css') }}">

    <link rel="stylesheet" href="{{asset('public/jobfinder/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{asset('public/jobfinder/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{asset('public/jobfinder/css/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{asset('public/jobfinder/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{asset('public/jobfinder/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{asset('public/jobfinder/css/bootstrap-datepicker.css') }}">
    <link rel="stylesheet" href="{{asset('public/jobfinder/css/animate.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/mediaelement@4.2.7/build/mediaelementplayer.min.css">
    <link rel="stylesheet" href="{{asset('public/jobfinder/fonts/flaticon/font/flaticon.css') }}">
    <link rel="stylesheet" href="{{asset('public/jobfinder/css/aos.css') }}">
    <link rel="stylesheet" href="{{asset('public/jobfinder/css/style.css') }}">
    <script src="{{ asset('public/jobfinder/js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{ asset('public/askme/js/sweetalert2.js') }}"></script>

    
  </head>
  <body>
    <div class="site-wrap">
        <div class="site-mobile-menu">
                <div class="site-mobile-menu-header">
                    <div class="site-mobile-menu-close mt-3">
                        <span class="icon-close2 js-menu-toggle"></span>
                    </div>
                </div>
            <div class="site-mobile-menu-body"></div>
        </div> <!-- .site-mobile-menu -->
        @include('layouts.jobpartials.topmenu')
        
        @yield('content')
        
        @include('layouts.jobpartials.footer')
    </div>
    <script src="{{ asset('public/jobfinder/js/jquery-migrate-3.0.1.min.js')}}"></script>
    <script src="{{ asset('public/jobfinder/js/jquery-ui.js')}}"></script>
    <script src="{{ asset('public/jobfinder/js/popper.min.js')}}"></script>
    <script src="{{ asset('public/jobfinder/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('public/jobfinder/js/owl.carousel.min.js')}}"></script>
    <script src="{{ asset('public/jobfinder/js/jquery.stellar.min.js')}}"></script>
    <script src="{{ asset('public/jobfinder/js/jquery.countdown.min.js')}}"></script>
    <script src="{{ asset('public/jobfinder/js/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{ asset('public/jobfinder/js/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{ asset('public/jobfinder/js/aos.js')}}"></script>

  
  <script src="{{ asset('public/jobfinder/js/mediaelement-and-player.min.js')}}"></script>

  <script src="{{ asset('public/jobfinder/js/main.js')}}"></script>
</body>
</html>