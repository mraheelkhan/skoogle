@extends('layouts.home')
@section('content')
@if(Session::has('message'))
    <p class="alert alert-success">{!! Session::get('message') !!}</p>    
@elseif(Session::has('error'))
    <p class="alert alert-danger">{!! Session::get('error') !!}</p>
@endif
@if(session('failed'))
    <script>
      $( document ).ready(function() {
        swal.fire("Failed", "{!! Session::get('error') !!}", "error");
      });
      
    </script>
@endif
    <!--------------------ARTICLES START------------------------->

    <section class="slider_area row m0">
        <div class="slider_inner">
            <div data-thumb="images/slider-1.jpg" data-src="{{ asset('public/img/slider-1.jpg') }}">
                <div class="camera_caption">
                   <div class="container">
                        <h5 class=" wow fadeInUp animated">Take Courses</h5>
                        <h3 class=" wow fadeInUp animated" data-wow-delay="0.5s">Understand the trending technologies</h3>
                        <p class=" wow fadeInUp animated" data-wow-delay="0.8s">Take Artificial Intelligence course from our experts and practically learn how you can integrate this trending technology with the IoT devices.</p>
                        <a class=" wow fadeInUp animated" data-wow-delay="1s" href="{{ route('Register')}}">Register Now</a>
                   </div>
                </div>
            </div>
            <div data-thumb="images/slider-2.jpg" data-src="{{ asset('public/img/slider-2.jpg') }}">
                <div class="camera_caption">
                   <div class="container">
                        <h5 class=" wow fadeInUp animated">Collaborate with Experts</h5>
                        <h3 class=" wow fadeInUp animated" data-wow-delay="0.5s">You got Idea & we got team</h3>
                        <p class=" wow fadeInUp animated" data-wow-delay="0.8s">Connect to our network of experts and build your idea into a product and get yourself known into IT industry where opportunities are waiting for you.</p>
                        <a class=" wow fadeInUp animated" data-wow-delay="1s" href="{{route('Register')}}">Regsiter Now</a>
                   </div>
                </div>
            </div>
        </div>
    </section>

    <section class="about_us_area row">
        <div class="container">
            <div class="tittle wow fadeInUp">
                <h2>ABOUT US</h2>
                <h4>Join us and communicate with IT Industry's Experts to find your way to Trending Technologies.</h4>
            </div>
            <div class="row about_row">
                <div class="who_we_area col-md-7 col-sm-6">
                    <div class="subtittle">
                        <h2>WHO WE ARE</h2>
                    </div>
                    <p>Skoogle is a team of software engineers working with many organizations to seek the hidden skills of emplyees and make them utilize them in the best possible way that would not only benefit the employee but the whole company. The main purpose of the existence of skoogle is to facilitate any individual to leverage their hidden talents, or those who know and haven't found any professional to guide them through.


                    Youngsters in our society are looking for jobs even though the best job for them is just a step away, but they can't reach out for it because they don't feel confident to apply due to their lack of experience and socialization with experienced personalities of the society who have so much knowledge to teach.</p>
                    <a href="{{route('Register')}}" class="button_all">Register Now</a>
                </div>
                <div class="col-md-5 col-sm-6 about_client">
                    <img src="{{ asset('public/img/about_client.jpg') }}" alt="">
                </div>
            </div>
        </div>
    </section>

    <section class="what_we_area row">
        <div class="container">
            <div class="tittle wow fadeInUp">
                <h2>WHAT WE OFFER</h2>
                <h4>A platform where Newbies and IT Industry experts can communicate and get maximum benefit</h4>
            </div>
            <div class="row construction_iner">
                <div class="col-md-4 col-sm-6 construction">
                   <div class="cns-img">
                        <img src="{{ asset('public/img/cns-1.jpg') }}" alt="">
                   </div>
                   <div class="cns-content">
                        <i class="fa fa-users" aria-hidden="true"></i> 
                        <a href="#">TEAM BUILDING</a>
                        <p>Have productive discussions on your field of interest and build a team who can guide you and facilitate you with your future work </p>
                   </div>
                </div>
                <div class="col-md-4 col-sm-6 construction">
                   <div class="cns-img">
                        <img src="{{ asset('public/img/cns-2.jpg') }}" alt="">
                   </div>
                   <div class="cns-content">
                        <i class="  fa fa-briefcase" aria-hidden="true"></i>
                        <a href="#">CAREER OPPOTUNITY</a>
                        <p>Meet the IT experts and get various oppotunities for changing your passion to profession </p>
                   </div>
                </div>
                <div class="col-md-4 col-sm-6 construction">
                   <div class="cns-img">
                        <img src="{{ asset('public/img/cns-3.jpg') }}" alt="">
                   </div>
                   <div class="cns-content">
                        <i class="fa fa-gavel" aria-hidden="true"></i>
                        <a href="#">BEGIN YOUR STARTUP</a>
                        <p>Engage yourself with experts, and initiate your entrepreneurial career by teaming up with one or multiple fellow professionals </p>
                   </div>
                </div>
            </div>
        </div>
    </section>


@endsection