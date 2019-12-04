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
    @if(auth()->check() && auth()->user()->isPro != 1)
    <section class="serviceoffer">
            <div class="container">
                <div class="row service_skill">
                    <div class="service_test"> 
                
                    <p>READY TO OFFER YOUR SKILLS?</p>
                    <p>Earn 10 skoogle coins &amp; unlock the Matching Game by posting your first service. Not sure what to offer? <a href="#">Take our skill test</a></p> 
                    </div>
                    <div class="service_offer">
                        <li><a href="{{route('ServiceOffer') }}">Offer a Service</a></li>
                    </div>
                    </div>
                </div>
            
        </section>

        @endif


    <section class="blog_tow_area">
        <div class="container">

                @if(auth()->check() && auth()->user()->isPro == 1)
                <h3 class="text-center">My Services: <a href="{{ route('ServiceMy') }}">{{ count($services) }} - Show </a></h3>
                <div class="row blog_tow_row mb-5 text-center" style="margin: 20px 1px;">
                    <a href="{{ route('ServiceCreate') }}" class="btn btn-primary">Create New Service</a>
                </div>
                @endif

                
           <div class="row blog_tow_row"  style="margin: 50px 1px;">
               @foreach($services as $service)
                <div class="col-md-4 col-sm-6">
                    <div class="renovation">
                        <img src="{{ asset('public/uploads/serviceImages/' . $service->image) }}"  style="border: 1px solid black;"  alt="">
                        <div class="renovation_content">
                            <a class="clipboard" href="#"><i class="fa fa-clipboard" aria-hidden="true"></i></a>
                        <a class="tittle" href="{{route('ServiceShow', $service->url)}}">{{$service->title}}</a>
                            <div class="date_comment">
                                <a href="#"><i class="fa fa-user" aria-hidden="true"></i>{{ $service->user->fname }}</a>
                                <a href="#"><i class="fa fa-commenting-o" aria-hidden="true"></i>{{ $service->price }} - PKR</a>
                            </div>
                            <p>{!! substr($service->description,0,100)!!}</p>
                        </div>
                    </div>
                </div>
                @endforeach
                
               
           </div>
        </div>
    </section>
    <!-- End blog-2 area -->
@endsection