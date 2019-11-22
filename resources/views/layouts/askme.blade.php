<html>
    <head>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	
	<!-- Main Style -->
	{{-- <link rel="stylesheet" href="{{ asset('public/askme/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('public/askme/css/base.css') }}">
	<link rel="stylesheet" href="{{ asset('public/askme/css/lists.css') }}">
	<link rel="stylesheet" href="{{ asset('public/askme/css/prettyPhoto.css') }}">
	<link rel="stylesheet" href="{{ asset('public/askme/css/fontello/css/fontello.css') }}">
	<link rel="stylesheet" href="{{ asset('public/askme/css/font-awesome/css/font-awesome.min.css') }}"> --}}
	<link rel="stylesheet" href="{{ asset('public/askme/css/style.css') }}">
	
	<!-- Skins -->
	<link rel="stylesheet" href="{{ asset('public/askme/css/skins/skins.css') }}">
	{{-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> --}}
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<!-- Responsive Style -->
	<link rel="stylesheet" href="{{ asset('public/askme/css/responsive.css') }}">
	
	<!-- Favicons -->
    <script src="{{ asset('public/askme/js/jquery.min.js') }}"></script>
    <script src="{{ asset('public/askme/js/sweetalert2.js') }}"></script>
	<link rel="shortcut icon" href="{{ asset('public/askme/images/favicon.png') }}">
    </head>
    <body>

        <div class="loader">
            <div class="loader_html"></div>
        </div>
        <div id="wrap" class="grid_1200">
            @include('layouts.askmepartials.topmenu')
            @yield('topbanner')
            <section class="container main-content">
                    <div class="row">
                    @yield('content')
                    {{-- @include('layouts.askmepartials.sidebar') --}}
                </div>
            </section>
            @include('layouts.askmepartials.footer')


               
        </div>         

    <!-- js -->
    <script src="{{ asset('public/askme/js/jquery-ui-1.10.3.custom.min.js') }}"></script>
    <script src="{{ asset('public/askme/js/jquery.easing.1.3.min.js') }}"></script>
    <script src="{{ asset('public/askme/js/html5.js') }}"></script>
    <script src="{{ asset('public/askme/js/twitter/jquery.tweet.js') }}"></script>
    <script src="{{ asset('public/askme/js/jflickrfeed.min.js') }}"></script>
    <script src="{{ asset('public/askme/js/jquery.inview.min.js') }}"></script>
    <script src="{{ asset('public/askme/js/jquery.tipsy.js') }}"></script>
    <script src="{{ asset('public/askme/js/tabs.js') }}"></script>
    <script src="{{ asset('public/askme/js/jquery.flexslider.js') }}"></script>
    <script src="{{ asset('public/askme/js/jquery.prettyPhoto.js') }}"></script>
    <script src="{{ asset('public/askme/js/jquery.carouFredSel-6.2.1-packed.js') }}"></script>
    <script src="{{ asset('public/askme/js/jquery.scrollTo.js') }}"></script>
    <script src="{{ asset('public/askme/js/jquery.nav.js') }}"></script>
    <script src="{{ asset('public/askme/js/tags.js') }}"></script>
    <script src="{{ asset('public/askme/js/jquery.bxslider.min.js') }}"></script>
    <script src="{{ asset('public/askme/js/custom.js') }}"></script>
    <!-- End js -->

</body>