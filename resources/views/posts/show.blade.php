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
                        
                            @if(auth()->check())
                            <p> {!!$post->post_content!!}</p>
                            @else 
                            <p>{!! substr($post->post_content,0,500)!!}</p>
                            <a href="{{url('/login')}}"><h1> Please login to continue reading</h1></a>
                            @endif
                        
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
                        
                            <div class="row blog_tow_row">
                                    {{-- <h3> Already Enrolled </h3> --}}
                                    
    @foreach($comments as $comment)
    <div class="card card-white post" id="comment_wraper{{$comment->id}}">
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
                @else 
                {{-- <a class="hide" id="reportedLabel{{$comment->id}}">Reported</a> --}}
                <a class="badge badge-danger" data-toggle="collapse" href="#report{{$comment->id}}" role="button" aria-expanded="false" aria-controls="report" id="reportBtn{{$comment->id}}">
                        Report 
                    </a>
                    <div class="collapse" id="report{{$comment->id}}">
                        <div class="card card-body">
                            <form method="POST" action="{{ route('CommentReportStore')}}">
                                @csrf
                                <input type="hidden" name="comment_id" value="{{$comment->id}}"/>
                                <div class="form-group">
                                    <label>Select Report Reason</label><br/>
                                    <input type="radio" value="Hate Speach" name="report_reason">
                                    <label>Hate Speach</label>
                                    <input type="radio" value="False Info"name="report_reason">
                                    <label>False Info</label>
                                    <input type="radio" value="Harrassment"name="report_reason">
                                    <label>Harrassment</label>
                                    <input type="submit" class="btn btn-info btn-sm" value="Report"/>
                                </div>
                               

                            </form>
                        </div>
                    </div>
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
       </div>
    </section>

    
<script>
    function reportComment(reason_id, comment_id){

        // alert(reason_id + " and " + comment_id);
        $('#report'+comment_id).hide();
        $('#reportBtn'+comment_id).hide();
        $('#reportedLabel'+comment_id).show();
        $('#comment_wraper'+comment_id).addClass('bg-danger');
    }
</script>
@endsection