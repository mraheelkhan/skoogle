<!-- Top Header_Area -->
<section class="top_header_area">
    <div class="container">
        <ul class="nav navbar-nav top_nav">
            <li><a href="#"><i class="fa fa-phone"></i>+92 (334) 909 6226</a></li>
            <li><a href="#"><i class="fa fa-envelope-o"></i>info@skoogle.com</a></li>
            <!--<li><a href="#"><i class="fa fa-clock-o"></i>Mon - Sat 12:00 - 20:00</a></li>-->
        </ul>
        
            <ul class="profile-wrapper">
                <li>
            <!-- user profile -->
                    <div class="profile">
                    {{-- <img src="{{ asset('public/askme/images/profile.jpg')}}" /> --}}
                    @if(auth()->check())
                    <a href="#" class="name">Welcome {{ auth()->user()->fname }}!</a>
                    @else
                    <a href="{{ url('login') }}" class="name">Welcome Guest!</a>
                    @endif
                <!-- more menu --> 
                <ul class="menu">
                <li><a href="{{ route('ProfileAccount')}}">My Account</a></li>
                    {{-- <li><a href="#">Post a Request</a></li>
                    <li><a href="#">Offer a Service</a></li> --}}
                    @if(auth()->check())
                    <li><a href="{{ route('logout') }}">Logout</a></li>
                    @else
                    <li><a href="{{ url('login') }}">Login</a></li>
                    @endif
                </ul>
            </div>
            </li>
                            
        </ul> 
    <!--        <ul class="nav navbar-nav navbar-right social_nav">
            <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
            <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
            <li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
            <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
            <li><a href="#"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a></li>
        <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>-->
    <!--<ul class="profile-wrapper">
        <li>
            
            <div class="profile">
                <img src="http://gravatar.com/avatar/0e1e4e5e5c11835d34c0888921e78fd4?s=80" />
                <a href="http://swimbi.com" class="name">swimbi.com</a>-->
    </div>
</section>
<!-- End Top Header_Area -->

<!-- Header_Area -->
@php 
if(Route::currentRouteName() == 'Chatroom' || Route::currentRouteName() == 'ChatUserShow')
{
    $show = 0;
} else {
    $show = 1;
}
@endphp
@if ($show != 0)
<nav class="navbar navbar-default header_aera" id="main_navbar">
    <div class="container">
        <!-- searchForm -->
        <div class="searchForm">
            <form action="#" class="row m0">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-search"></i></span>
                    <input type="search" name="search" class="form-control" placeholder="Type & Hit Enter">
                    <span class="input-group-addon form_hide"><i class="fa fa-times"></i></span>
                </div>
            </form>
        </div><!-- End searchForm -->
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="col-md-2 p0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#min_navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{route('Home')}}"><img src="{{ asset('public/askme/images/logo.png') }}" alt=""></a>
            </div>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="col-md-10 p0">
            <div class="collapse navbar-collapse" id="min_navbar">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="{{route('Home')}}">Newsfeed</a></li>
                    {{-- @if(auth()->check() && auth()->user()->isPro == 1)
                    <li><a href="{{route('PostMy')}}">My Articles</a></li>
                    @endif --}}
                    <li><a href="{{route('PostAll')}}">Articles</a></li>
                    <li><a href="{{route('ServicesAll')}}">Services</a></li>
                    <li><a href="{{route('ProjectsAll')}}">Projects</a></li>
                    <li class="dropdown submenu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Courses</a>
                        <ul class="dropdown-menu other_dropdwn">
                            @if(auth()->check() && auth()->user()->isPro == 1)
                            <li><a href="{{ route('CourseMy') }}">My Courses </a></li>
                            @endif
                            @foreach($courses as $course)
                            <li><a href="{{ route('CourseCategoryShow',$course->id) }}">{{ $course->category_name }} </a></li>
                            @endforeach                           
                        </ul>
                        
                    </li>
                <li><a href="{{route('JobAll')}}">Career</a></li>
                    <li><a href="{{route('ForumAll')}}">Forum</a></li>
                    <li><a href="{{route('Chatroom')}}">Chat</a></li>
                    @if(!auth()->check())
                    <li><a href="{{url('/login')}}">Login</a></li>
                    <li><a href="{{ url('/signup')}}">Sign Up</a></li>
                    @else
                    <li><a href="{{url('/logout')}}">Logout</a></li>
                    @endif
                    {{-- <li><a href="#" class="nav_searchFrom"><i class="fa fa-search"></i></a></li> --}}
                </ul>
            </div><!-- /.navbar-collapse -->
        </div>
    </div><!-- /.container -->
</nav>
@endif
<!-- End Header_Area -->