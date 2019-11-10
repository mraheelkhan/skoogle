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
           <div class="video text-center">
             <h2 class="mb-5">{{ $video->title }}</h2>
            <iframe src="{{ asset('public/uploads/videos/' . $video->file_name) }}" autoplay="off" width="540" height="310"></iframe>
           <p> {{ $video->description }}</p>
        </div>
       </div>
    </div>
</section>
@endsection