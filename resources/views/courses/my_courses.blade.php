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
        <div class="row blog_tow_row mb-5 text-center">
            <a href="{{ route('CourseCreate') }}" class="btn btn-primary">Create New Course</a>
        </div>
        @endif
       <div class="row blog_tow_row">
            @foreach($showcourses as $course)
            <div class="col-md-4 col-sm-6">
                <div class="renovation">
                    {{-- <img src="images/blog/renovation/r-1.jpg" alt=""> --}}
                    <div class="renovation_content">
                            @if(auth()->check() && auth()->user()->isPro == 1 && auth()->user()->id == $course->user_id)
                            <div class="text-right">
                                    <a href="{{route('CourseDelete', $course->id)}}" class="btn btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                    <a  href="{{route('CourseEnroll',  $course->id )}}" class="btn btn-primary">
                                        <i class="fa fa-plus"></i>
                                    </a>
                                </div>
                            @endif
                        {{-- <a class="clipboard" href="#"><i class="fa fa-clipboard" aria-hidden="true"></i></a> --}}
                    <a class="tittle" href="{{ route('CourseShow', [str_replace(" ", "-", $course->category->category_name), $course->id]) }}">{{ $course->title }}</a>
                        <div class="date_comment">
                            <a href="#"><i class="fa fa-calendar" aria-hidden="true"></i>{{ $course->created_at }}</a>
                            <a href="#"><i class="fa fa-commenting-o" aria-hidden="true"></i>3</a>
                        </div>
                        <p>{!! substr($course->description,0,100)!!}</p>
                        
                    </div>
                    
                </div>
            </div>
            @endforeach
       </div>
    </div>
</section>
@endsection