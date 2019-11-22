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
    <section class="blog_all">
            <div class="container">
                <div class="row m0 blog_row">
                    <div class="col-sm-8 main_blog">
                        <img src="{{ asset('public/uploads/postImages/' . $post->image) }}" alt="">
                        <div class="col-xs-1 p0">
                           <div class="blog_date">
                                {{ date("d-M", strtotime($post->created_at)) }}
                           </div>
                        </div>
                        <div class="col-xs-11 blog_content">
                            <a class="blog_heading" href="#">{{$post->post_title}}</a>
                            <a class="blog_admin" href="#"><i class="fa fa-user" aria-hidden="true"></i>{{$post->user->fname . " " . $post->user->lname}}</a>
                            
                            {!!$post->post_content!!}
                        </div>
                        <!-----------------------------------COMMENT AREA START---------------------------------->
                        
                    <!---------------------------------Comment AREA--------------------------------->
                       
                    </div>
                    <!-------------------------------END Comment-------------------------------------->
                    <div class="col-sm-4 widget_area">
                        <div class="resent">
                            <h3>RECENT POSTS</h3>
                            @foreach($posts as $post)
                                <div class="media">
                                    <div class="media-left">
                                        <a href="#">
                                            {{-- <img class="media-object" src="{{ asset('public/uploads/postImages/' . $post->image) }}" alt=""> --}}
                                        </a>
                                    </div>
                                    <div class="media-body">
                                            <a class="" href="{{route('PostShow', $post->post_url)}}">
                                                {{$post->post_title}}
                                            </a>
                                        <h6>{{$post->created_at}}</h6>
                                    </div>
                                </div>
                                @endforeach
                           
                        </div>
                        <div class="resent">
                            <h3>Projects</h3>
                            <ul class="tag">
                                
                                @foreach($projects as $project)
                                <li><a href="{{ route('ProjectShow', $project->url) }}">{{$project->title}}</a></li>
                                @endforeach
                                
                            </ul>
                        </div>
                        
                    </div>
                </div>
            </div>
        </section>
    <section class="blog_tow_area">
        <div class="container">
           <div class="row blog_tow_row">
              <h2 class="text-center m-5" style="margin: 20px 1px;">Latest Articles</h2>
               @foreach($posts as $post)
                   
                <div class="col-md-4 col-sm-6">
                    <div class="renovation">
                        <img src="{{ asset('public/uploads/postImages/' . $post->image) }}"  style="border: 1px solid black;"  alt="">
                        <div class="renovation_content">
                            <a class="clipboard" href="#"><i class="fa fa-clipboard" aria-hidden="true"></i></a>
                        <a class="tittle" href="{{route('PostShow', $post->post_url)}}">{{$post->post_title}}</a>
                            <div class="date_comment">
                                <a href="#"><i class="fa fa-calendar" aria-hidden="true"></i>{{ date("d-M", strtotime($post->created_at)) }}</a>
                                {{-- <a href="#"><i class="fa fa-commenting-o" aria-hidden="true"></i>3</a> --}}
                            </div>
                            <p>{!! substr($post->post_content,0,100)!!}</p>
                        </div>
                    </div>
                </div>
                
                @endforeach
                
               
           </div>
        </div>
    </section>

    <section class="blog_tow_area">
            <div class="container">
               <div class="row blog_tow_row">
                  <h2 class="text-center m-5" style="margin: 20px 1px;">Latest Jobs</h2>
                   @foreach($jobs as $job)
                       
                    <div class="col-md-4 col-sm-6">
                        <div class="renovation">
                            <img src="{{ asset('public/uploads/postImages/' . $job->image) }}"  style="border: 1px solid black;"  alt="">
                            <div class="renovation_content"  style="height: 200px;">
                                <a class="clipboard" style="background: #000;" href="#"><i class="fa fa-file" aria-hidden="true"></i></a>
                            <a class="tittle" href="{{route('JobShow', $job->id)}}">{{$job->job_title}}</a>
                                <div class="date_comment">
                                    <a href="#"><i class="fa fa-calendar" aria-hidden="true"></i>{{ date("d-M", strtotime($job->created_at)) }}</a>
                                    {{-- <a href="#"><i class="fa fa-commenting-o" aria-hidden="true"></i>3</a> --}}
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    
                    @endforeach
                    
                   
               </div>
            </div>
    </section>

    <section class="blog_tow_area">
        <div class="container">
           <div class="row blog_tow_row">
              <h2 class="text-center m-5" style="margin: 40px 1px;">Latest Service</h2>
               @foreach($services as $service)
                   
                <div class="col-md-4 col-sm-6">
                    <div class="renovation">
                        {{-- <img src="{{ asset('public/uploads/postImages/' . $service->image) }}"  style="border: 1px solid black;"  alt=""> --}}
                        <div class="renovation_content"  style="height: 200px;">
                            <a class="clipboard" style="background: #023866;" href="#"><i class="fa fa-file" aria-hidden="true"></i></a>
                        <a class="tittle" href="{{route('ServiceShow', $service->id)}}">{{$service->title}}</a>
                            <div class="date_comment">
                                <a href="#"><i class="fa fa-calendar" aria-hidden="true"></i>{{ date("d-M", strtotime($job->created_at)) }}</a>
                                {{-- <a href="#"><i class="fa fa-commenting-o" aria-hidden="true"></i>3</a> --}}
                            </div>
                            
                        </div>
                    </div>
                </div>
                
                @endforeach
                
               
           </div>
        </div>
    </section>

    <section class="blog_tow_area">
        <div class="container">
           <div class="row blog_tow_row">
              <h2 class="text-center m-5" style="margin: 40px 1px;">Latest Projects</h2>
               @foreach($projects as $project)
                   
                <div class="col-md-4 col-sm-6">
                    <div class="renovation">
                        {{-- <img src="{{ asset('public/uploads/postImages/' . $project->image) }}"  style="border: 1px solid black;"  alt=""> --}}
                        <div class="renovation_content"  style="height: 200px;">
                            <a class="clipboard" style="background: #023866;" href="#"><i class="fa fa-file" aria-hidden="true"></i></a>
                        <a class="tittle" href="{{route('ProjectShow', $project->url)}}">{{$project->title}}</a>
                            <div class="date_comment">
                                <a href="#"><i class="fa fa-calendar" aria-hidden="true"></i>{{ date("d-M", strtotime($job->created_at)) }}</a>
                                {{-- <a href="#"><i class="fa fa-commenting-o" aria-hidden="true"></i>3</a> --}}
                            </div>
                            
                        </div>
                    </div>
                </div>
                
                @endforeach
                
               
           </div>
        </div>
    </section>
    <!-- End blog-2 area -->
@endsection