@extends('layouts.home')
@section('content')
<section class="blog_tow_area">
    <div class="container">
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
        @if(auth()->check() && auth()->user()->isPro == 1)
        <h1 class="text-center">My Services: {{ count($services) }}</h1>
        <div class="row blog_tow_row mb-5 text-center">
            <a href="{{ route('ServiceCreate') }}" class="btn btn-primary">Create New Service</a>
        </div>
        @endif
       <div class="row blog_tow_row">
            @foreach($services as $service)
            <div class="col-md-4 col-sm-6">
                <div class="renovation">
                    {{-- <img src="images/blog/renovation/r-1.jpg" alt=""> --}}
                    <div class="renovation_content">
                            @if(auth()->check() && auth()->user()->isPro == 1 && auth()->user()->id == $service->user_id)
                            <div class="text-right">
                                    <a href="{{route('ServiceDelete', $service->id)}}" class="btn btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </div>
                            @endif
                        {{-- <a class="clipboard" href="#"><i class="fa fa-clipboard" aria-hidden="true"></i></a> --}}
                    <a class="tittle" href="{{ route('ServiceShow', $service->url) }}">{{ $service->title }}</a>
                        <div class="date_comment">
                            <a href="#"><i class="fa fa-calendar" aria-hidden="true"></i>{{ $service->created_at }}</a>
                            {{-- <a href="#"><i class="fa fa-commenting-o" aria-hidden="true"></i>3</a> --}}
                        </div>
                        <p>{!! substr($service->description,0,100)!!}</p> 
                    </div>
                    
                </div>
            </div>
            @endforeach
       </div>
    </div>
</section>
@endsection