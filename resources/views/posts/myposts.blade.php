@extends('layouts.home')
@section('content')

    <!--------------------ARTICLES START------------------------->
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
                <a href="{{ route('PostCreate') }}" class="btn btn-primary">Write a New Article</a>
            </div>
            @endif
           <div class="row blog_tow_row">
                @foreach($posts as $post)
                <div class="col-md-4 col-sm-6">
                    <div class="renovation">
                        <img class="" style="border: 1px solid black;" src="{{ asset('public/uploads/postImages/' . $post->image) }}" class="img-responsive" style="width: 100%;" alt="">
                        <div class="renovation_content">
                                <a class="clipboard" href="#"><i class="fa fa-clipboard" aria-hidden="true"></i></a>
                                @if(auth()->user()->id == $post->user_id)
                                <div class="text-right">
                                        <a href="{{route('PostDelete', $post->id)}}" class="btn btn-danger">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                        <a  href="{{route('PostEdit', $post->id)}}" class="btn btn-primary">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    </div>
                                @endif
                        <a class="tittle" href="{{ route('PostShow', $post->post_url) }}">{{ $post->post_title }}</a>
                            <div class="date_comment">
                                <a href="#"><i class="fa fa-calendar" aria-hidden="true"></i>{{ date("d-M", strtotime($post->created_at)) }}</a>
                                {{-- <a href="#"><i class="fa fa-commenting-o" aria-hidden="true"></i>3</a> --}}
                            </div>
                            <p style="padding: 0px;">{!! substr($post->post_content,0,100)!!}</p>
                            
                        </div>
                        
                    </div>
                </div>
                @endforeach
           </div>
        </div>
    </section>
    <!-- End blog-2 area -->
@endsection