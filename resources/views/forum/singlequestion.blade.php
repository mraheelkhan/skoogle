@extends('layouts.askme')
@section('topbanner')
<div class="breadcrumbs">
		<section class="container">
			<div class="row">
				<div class="col-md-12">
					<h1>{{ $question->question_title }}</h1>
				</div>
				<div class="col-md-12">
					<div class="crumbs">
                    <a href="{{route('ForumAll')}}">Home</a>
						<span class="crumbs-span">/</span>
						<a href="{{route('ForumAll')}}">Questions</a>
						<span class="crumbs-span">/</span>
                    <span class="current">{{ $question->question_title }}</span>
					</div>
				</div>
			</div><!-- End row -->
		</section><!-- End container -->
	</div>
@endsection
@section('content')
<style>
        .about-author .author-bio {
            overflow: hidden;
            height: auto;
        }
        .question-vote {
            height: auto;
        }
        .commentlist li .comment-meta {
            height: auto;
        }
        .comment-author a {
            color: #78797b;
        }
        .commentlist li p {
            font-size: 14px;
            color: #000;
        }
    
    </style>    
<div class="col-md-9"   style="overflow: unset; height: auto;">
        <article class="question single-question question-type-normal">
            <h2>
               
                        {{ $question->question_title }}
               
            </h2>
            <a class="question-report" href="#">Report</a>  
            <div class="question-inner">
                <div class="clearfix"></div>
                <div class="question-desc">
                <p>{{ $question->question_body }}}</p>
                </div>
                <div class="question-details">
                    <span class="question-answered question-answered-done"><i class="icon-ok"></i>
                        {{ $question->status }}</span>
                    {{-- <span class="question-favorite"><i class="icon-star"></i>5</span> --}}
                </div>
                <span class="question-category"><a href="#"><i class="icon-folder-close"></i>
                    {{ $question->category->category_name}}</a></span>
                <span class="question-date"><i class="icon-time"></i>{{ $question->created_at->diffForHumans()}}</span>
                {{-- <span class="question-comment"><a href="#"><i class="icon-comment"></i>5 Answer</a></span> --}}
                <span class="single-question-vote-result">+22</span>
                <ul class="single-question-vote">
                    {{-- <li><a href="#" class="single-question-vote-down" title="Dislike"><i class="icon-thumbs-down"></i></a></li> --}}
                    <li><a href="#" class="single-question-vote-up" title="Like"><i class="icon-thumbs-up"></i></a></li>
                </ul>
                <div class="clearfix"></div>
            </div>
        </article>
        
        
        <div class="about-author clearfix">
            <div class="author-image">
                <a href="#" original-title="admin" class="tooltip-n"><img alt="" src="{{ asset('public/img/staff/'.$question->user->avatar) }}"></a>
            </div>
            <div class="author-bio">
            <h4>About the Author -  {{ $question->user->fname }} {{ $question->user->lname }}</h4>
                [[UPDATE IT]]Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed viverra auctor neque. Nullam lobortis, sapien vitae lobortis tristique.
            </div>
        </div><!-- End about-author -->
        @if( auth()->check() && $question->user_id == auth()->user()->id )
        <h1> thisISOWNEROFQUESTION </h1>
        @endif
        <div id="commentlist" class="page-content">
        <div class="boxedtitle page-title"><h2>Answers ( <span class="color">{{count($answers)}}</span> )</h2></div>
            <ol class="commentlist clearfix">
                @foreach($answers as $answer)
                <li class="comment" style=" @if($answer->isSolution == 1) background:#b8ff94 @endif">
                    <div class="comment-body comment-body-answered clearfix"> 
                        <div class="avatar"><img alt="" src="{{ asset('public/img/staff/'.$answer->user->avatar) }}"></div>
                        <div class="comment-text">
                            <div class="author clearfix">
                                <div class="comment-author"><a href="#">{{ $answer->user->fname }} {{ $answer->user->lname }}</a></div>
                                @if( auth()->check() && $solved == 0 && $question->user_id == auth()->user()->id)
                                <div class='comment-author' style="float:right">
                                    <button class="btn btn-success" onclick="markAsSolution({{$answer->id}})" title="Mark as Solution"><i class="icon-ok"></i></button>
                                </div>
                                @endif
                                <button class="btn btn-info" onclick="markAsSolution({{$answer->id}})" title="Mark as Solution"><i class="far fa-support"></i></button>
                                {{-- <div class="comment-vote">
                                    <ul class="question-vote">
                                        <li><a href="#" class="question-vote-up" title="Like"></a></li>
                                        <li><a href="#" class="question-vote-down" title="Dislike"></a></li>
                                    </ul>
                                </div> --}}
                                {{-- <span class="question-vote-result">+1</span> --}}
                                <div class="comment-meta">
                                    <div class="date"><i class="icon-time"></i>{{ $answer->created_at->diffForHumans() }} </div> 
                                </div>
                                 
                            </div>
                            <div class="text"><p>{{ $answer->answer_body }}</p>
                            </div>
                            @if($answer->isSolution == 1)
                            <div class="question-answered question-answered-done"><i class="icon-ok"></i>Best Solution</div>
                            @endif
                        </div>
                    </div>
                </li>
                @endforeach
              
            </ol><!-- End commentlist -->
        </div><!-- End page-content -->
        
        <div id="respond" class="comment-respond page-content clearfix">
            <div class="boxedtitle page-title"><h2>Leave Your Answer</h2></div>
            <form action="{{ route('QuestionAnswerStore')}}" method="POST" id="commentform" class="comment-form">
                @csrf
                <input type="hidden" name="question_id" value="{{ $question->id }}" />
                <div id="respond-textarea">
                    <p>
                        <label class="required" for="answer_body">Answer<span>*</span></label>
                        <textarea id="answer_body" name="answer_body" aria-required="true" cols="58" rows="8"></textarea>
                    </p>
                </div>
                <p class="form-submit">
                    <input name="submit" type="submit" id="submit" value="Post your answer" class="button small color">
                </p>
            </form>
        </div>
        
        
    </div>
<script>
    function test(){
        alert('lsajfdlsajd');
    }
    function markAsSolution(id){
        data = {
            "question_id" : "{{ $question->id }}",
            "answer_id" : id,
            '_token' : "{{csrf_token()}}"
        }
        routeURL = "{{ route('AnswerMarkAsSolution') }}";
        $.ajax({
            url: routeURL,
            method: 'POST',
            data: {
                "question_id" : {{ $question->id }},
                "answer_id" : id,
                "_token" : "{{csrf_token()}}"
            },
            success: function(data){
                console.log(data);
                if(data.success == 1){
                    swal.fire('success', 'Mark Status Updated', "success");
                    location.reload();
                } else {
                    swal.fire('Already Solved', 'You cannot mark 2 answer as solution', "error");
                }
                
            },
            error: function(error){
                console.log(error);
            }
        });
    }

</script>   
@endsection