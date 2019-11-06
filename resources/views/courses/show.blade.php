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
       <div class="row blog_tow_row">
            @if(auth()->check() && auth()->user()->isPro == 1)
            <div class="row blog_tow_row mb-5 text-center">
                <a href="{{ route('CourseVideoCreate', $course_id) }}" class="btn btn-primary">Add New Video</a>
            </div>
            @endif

            @foreach($showcoursevideos as $video)
            <div class="col-md-4 col-sm-6">
                <div class="card">
                    <div class="card-body alert alert-success">
                            <div class="text-right">
                                    <a href="{{route('CourseVideoDelete', $video->id)}}" class="btn btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                    {{-- <a  href="{{route('CourseVideoEdit', $video->id)}}" class="btn btn-primary">
                                        <i class="fa fa-edit"></i>
                                    </a> --}}
                                </div>
                    <h4><a class="tittle" href="{{ route('CourseVideoShow', [str_replace(" ", "-",$video->course->title), $video->id]) }}">{{ $video->title }}</a></h4>
                    </div>
                </div>
            </div>
            @endforeach
       </div>
    </div>
</section>
@endsection