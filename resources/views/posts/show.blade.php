@extends('layouts.home');
@section('content')
<section class="blog_all">
        <div class="container">
            <div class="row m0 blog_row">
                <div class="col-sm-8 main_blog">
                    <img src="{{ asset('public/uploads/postImages/' . $post->image) }}" alt="">
                    <div class="col-xs-1 p0">
                       <div class="blog_date">
                          <a> {{ date("d-M", strtotime($post->created_at)) }}</a>
                       </div>
                    </div>
                    <div class="col-xs-11 blog_content">
                        <a class="blog_heading" href="#">{{$post->post_title}} </a>
                        <a class="blog_admin" href="#"><i class="fa fa-user" aria-hidden="true"></i>{{$post->user->fname . " " . $post->user->lname}}</a>
                        <ul class="like_share">
                            <li>
                                <a href="#"><i class="fa fa-comment" aria-hidden="true"></i>
                                    {{ count($comments)}}
                            </a></li>
                            
                        </ul>
                        <p>
                            {!!$post->post_content!!}
                        </p>
                    </div>
                    <!-----------------------------------COMMENT AREA START---------------------------------->
                    @if($post->is_comment == 1)
                    <!---------------------------------Comment AREA--------------------------------->
                    <div class="post_comment">
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
                        
                        <h3>Post A Comment</h3>
                        @if(auth()->check())
                    <form class="comment_box" action="{{route('CommentStore')}}" method="post">
                        @csrf
                        <input type="hidden" value="{{$post->id}}" name="post_id"/>
                           <div class="col-md-6">
                               <h4>Name</h4>
                           <input type="text" class="form-control input_box" id="" placeholder="" value="{{ auth()->user()->fname . " " . auth()->user()->lname }}" disabled>
                           </div>
                           <div class="col-md-6">
                               <h4>Email</h4>
                               <input type="text" class="form-control input_box" id="email" placeholder="" value="{{ auth()->user()->email }}" disabled>
                           </div>
                           <div class="col-md-12">
                               <h4>Your Comment</h4>
                               <textarea class="form-control input_box" placeholder="" name="comment_body"></textarea>
                               <button type="submit">Post Comment</button>
                           </div>
                        </form>
                        @else
                            <h3> Login to post a comment </h3>
                            @endif
                    </div>  
                    @endif
                    <div class="col-md-8">
                        @foreach($comments as $comment)
                        <div class="card card-white post">
                                <div class="post-heading">
                                    <div class="float-left meta">
                                        <div class="title h5">
                                            <a href="#"><b>{{$comment->user->fname . " " . $comment->user->lname }}</b></a>
                                            made a comment. <span class="text-muted time">{{$comment->created_at->diffForHumans()}}</span>
                                            @if(auth()->check() && $comment->user_id == auth()->user()->id)
                                            <span class="text-right">
                                                    <a href="{{route('CommentDelete', $comment->id)}}" class="btn btn-danger">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                    
                                                </span>
                                                @endif
                                        </div>
                                        
                                    </div>
                                </div> 
                                <div class="post-description"> 
                                    <p>{{$comment->comment_body}}</p>
                
                                </div>
                                <hr>
                            </div>
                            @endforeach
                        </div>
                </div>
                {{-- <div class="col-sm-4 widget_area">
                    <div class="resent">
                        <h3>RECENT POSTS</h3>
                        <div class="media">
                            <div class="media-left">
                                <a href="#">
                                    <img class="media-object" src="images/blog/rs-1.jpg" alt="">
                                </a>
                            </div>
                            <div class="media-body">
                                <a href="coding.html">Teach yourself new techniques, and make this learning process fun and exciting.</a>
                                <h6>Sep 29th, 2019</h6>
                            </div>
                        </div>
                        <div class="media">
                            <div class="media-left">
                                <a href="#">
                                    <img class="media-object" src="images/blog/rs-2.jpg" alt="">
                                </a>
                            </div>
                            <div class="media-body">
                                <a href="piano.html">Keyboard professionals are eagerly seeking passionate like you. Learn their best technique.</a>
                                <h6>Sep 29th, 2019</h6>
                            </div>
                        </div>
                        <div class="media">
                            <div class="media-left">
                                <a href="#">
                                    <img class="media-object" src="images/blog/rs-3.jpg" alt="">
                                </a>
                            </div>
                            <div class="media-body">
                                <a href="">Complete the fundamentals and learn Sketch’s intermediate features by designing wireframes and a lot more.</a>
                                <h6>Sep 29th, 2019</h6>
                            </div>
                        </div>
                    </div>
                    <div class="resent">
                        <h3>CATEGORIES</h3>
                        <ul class="architecture">
                            <li><a href="#"><i class="fa fa-arrow-right" aria-hidden="true"></i>Art</a></li>
                            <li><a href="#"><i class="fa fa-arrow-right" aria-hidden="true"></i>Photography</a></li>
                            <li><a href="#"><i class="fa fa-arrow-right" aria-hidden="true"></i>Programming</a></li>
                            <li><a href="#"><i class="fa fa-arrow-right" aria-hidden="true"></i>Cooking</a></li>
                        </ul>
                    </div>
                    <div class="resent">
                        <h3>ARCHIVES</h3>
                        <ul class="architecture">
                            <li><a href="#"><i class="fa fa-arrow-right" aria-hidden="true"></i>June 2019</a></li>
                            <li><a href="#"><i class="fa fa-arrow-right" aria-hidden="true"></i>July 2019</a></li>
                            <li><a href="#"><i class="fa fa-arrow-right" aria-hidden="true"></i>August 2019</a></li>
                        </ul>
                    </div>
                    <div class="search">
                        <input type="search" name="search" class="form-control" placeholder="Search">
                    </div>
                    <div class="resent">
                        <h3>Tag</h3>
                        <ul class="tag">
                            <li><a href="#">Creative</a></li>
                            <li><a href="#">Programming</a></li>
                            <li><a href="#">Architecture</a></li>
                            <li><a href="#">Software</a></li>
                            <li><a href="#">Design</a></li>
                            
                        </ul>
                    </div>
                </div> --}}
            </div>
        </div>
    </section>

@endsection