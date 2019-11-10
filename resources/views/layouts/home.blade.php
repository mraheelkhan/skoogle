<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Home - Skoogle</title>

    <!-- Favicon -->
    <link rel="icon" href="images/favicon.png" type="image/x-icon" />
    <!-- Bootstrap CSS -->
    <link href="{{ asset('/public/home/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Animate CSS -->
    <link href="{{ asset('/public/home/vendors/animate/animate.css')}}" rel="stylesheet">
    <!-- Icon CSS-->
	<link rel="stylesheet" href="{{ asset('/public/home/vendors/font-awesome/css/font-awesome.min.css')}}">
    <!-- Camera Slider -->
    <link rel="stylesheet" href="{{ asset('/public/home/vendors/camera-slider/camera.css')}}">
    <!-- Owlcarousel CSS-->
	<link rel="stylesheet" type="text/css" href="{{ asset('/public/home/vendors/owl_carousel/owl.carousel.css')}}" media="all">

    <!--Theme Styles CSS-->
	<link rel="stylesheet" type="text/css" href="{{ asset('/public/home/css/style.css')}}" media="all" />
    <script src="{{ asset('/public/askme/js/jquery.min.js')}}"></script>
    <script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
    <!-- select2 js code cdn     -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
    <script src="{{ asset('public/askme/js/sweetalert2.js') }}"></script>
     
    <style>
        .blog_tow_area .blog_tow_row .renovation .renovation_content {
            height: 350px;
        }
    </style>
    
</head>
<body>
    <!-- Preloader -->
    {{-- <div class="preloader"></div> --}}

	
    @include('layouts.homepartials.menu')
    <!-- Slider area -->

    <!-- End Slider area -->

    @yield('content')

      <!----------------ARTICLES END----------------------------->
        <!-- Footer Area -->
    @include('layouts.homepartials.footer')
    <!-- End Footer Area -->

    <!-- jQuery JS -->
   
    
    <!-- Bootstrap JS -->
    <script src="{{ asset('/public/home/js/bootstrap.min.js')}}"></script>
    <!-- Animate JS -->
    <script src="{{ asset('/public/home/vendors/animate/wow.min.js')}}"></script>
    <!-- Camera Slider -->
    <script src="{{ asset('/public/home/vendors/camera-slider/jquery.easing.1.3.js')}}"></script>
    <script src="{{ asset('/public/home/vendors/camera-slider/camera.min.js')}}"></script>
    <!-- Isotope JS -->
    <script src="{{ asset('/public/home/vendors/isotope/imagesloaded.pkgd.min.js')}}"></script>
    <script src="{{ asset('/public/home/vendors/isotope/isotope.pkgd.min.js')}}"></script>
    <!-- Progress JS -->
    <script src="{{ asset('/public/home/vendors/Counter-Up/jquery.counterup.min.js')}}"></script>
    <script src="{{ asset('/public/home/vendors/Counter-Up/waypoints.min.js')}}"></script>
    <!-- Owlcarousel JS -->
    <script src="{{ asset('/public/home/vendors/owl_carousel/owl.carousel.min.js')}}"></script>
    <!-- Stellar JS -->
    <script src="{{ asset('/public/home/vendors/stellar/jquery.stellar.js')}}"></script>
    <!-- Theme JS -->
    <script src="{{ asset('/public/home/js/theme.js')}}"></script>
</body>
</html>
