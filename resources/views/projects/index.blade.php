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
    
    <section class="blog_tow_area">
        <div class="container">

                @if(auth()->check() && auth()->user()->isPro == 1)
                <h3 class="text-center">My Projects: <a href="{{ route('ProjectMy') }}">{{ count($projects) }} - Show </a></h3>
                <div class="row blog_tow_row mb-5 text-center" style="margin: 20px 1px;">
                    <a href="{{ route('ServiceCreate') }}" class="btn btn-primary">Create New Project</a>
                </div>
                @endif

                
           <div class="row blog_tow_row"  style="margin: 50px 1px;">
               @foreach($projects as $project)
                <div class="col-md-4 col-sm-6">
                    <div class="renovation ">
                        {{-- <img src="{{ asset('public/uploads/postImages/' . $project->image) }}"  style="border: 1px solid black;"  alt=""> --}}
                        <div class="renovation_content  @if($project->status == 2) bg-info @endif">
                            <a class="clipboard" href="#"><i class="fa fa-clipboard" aria-hidden="true"></i></a>
                        <a class="tittle" href="{{route('ProjectShow', $project->url)}}">{{$project->title}} 
                            @if($project->status == 2) <span class="badge badge-info"> *Closed</span>@endif
                        </a>
                            <div class="date_comment">
                                <a href="#"><i class="fa fa-user" aria-hidden="true"></i>{{ $project->user->fname }}</a>
                                <a href="#"><i class="fa fa-clock-o" aria-hidden="true"></i> {{ $project->end_date }} </a>
                            </div>
                            <p>{!! substr($project->description,0,100)!!}</p>
                        </div>
                    </div>
                </div>
                @endforeach
                
               
           </div>
        </div>
    </section>
    <!-- End blog-2 area -->
@endsection