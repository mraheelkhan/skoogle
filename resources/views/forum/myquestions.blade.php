@extends('layouts.askme')
@section('topbanner1')

    <div class="section-warp ask-me">
		<div class="container clearfix">
			<div class="box_icon box_warp box_no_border box_no_background" box_border="transparent" box_background="transparent" box_color="#FFF">
				<div class="row">
					<div class="col-md-3">
						<h2>Welcome to Skoogle</h2>
						<p>You can ask your question from the experts here at skoogle forum. Typically answer is posted around 1hour.</p>
						<div class="clearfix"></div>
						
						<a class="color button dark_button medium" href="#">Join Now</a>
					</div>
					<div class="col-md-9">
                        <form class="form-style form-style-2" style="background: url('{{ asset('public/askme/images/chrome.png')}}')">
                                <p>
                                    <textarea rows="4" id="question_title" onfocus="if(this.value=='Ask any question and you be sure find your answer ?')this.value='';" onblur="if(this.value=='')this.value='Ask any question and you be sure find your answer ?';">Ask any question and you be sure find your answer ?</textarea>
                                    <i class="icon-pencil"></i>
                                    <span class="color button small publish-question">Ask Now</span>
                                </p>
                        </form>
					</div>
				</div>
			</div>
		</div>
    </div>

@endsection
@section('content')

<div class="col-md-9"  style="overflow: unset; height: auto;">

    <div class="tabs-warp question-tab">
        
        <div class="tab-inner-warp" style="display: block;">
            <div class="tab-inner">
                
                @foreach($questions as $question)
                <article class="question question-type-normal">
                    <h2>
                    <a href="{{route('ForumShow', $question->id)}}">{{$question->question_title}}</a>
                    </h2>
                    {{-- <a class="question-report" href="#">Report</a> --}}
                    
                    <div class="question-author">
                        <a href="#" original-title="ahmed" class="question-author-img tooltip-n"><span></span><img alt="" src="{{ asset('public/img/staff/'.$question->user->avatar) }}"></a>
                    </div>
                    <div class="question-inner">
                        <div class="clearfix"></div>
                        <p class="question-desc">{{ $question->question_body }}</p>
                        <div class="question-details">
                        <span class="question-answered"><i class="icon-ok"></i> {{ $question->status }}</span>
                            {{-- <span class="question-favorite"><i class="icon-star"></i>5</span> --}}
                        </div>
                        <span class="question-category"><a href="#"><i class="icon-folder-close"></i>{{ $question->category->category_name}}</a></span>
                        <span class="question-date"><i class="icon-time"></i>{{ $question->created_at->diffForHumans()}}</span>
                        
                        <span>
                                <a type="button" href="{{ route('ForumDeleteUserQuestion', $question->id)}}"  class="btn btn-danger report-question btn-sm" >
                                        Delete
                                </a>
                                    
                        </span>
                        
                        {{-- <span class="question-comment"><a href="#"><i class="icon-comment"></i>5 Answer</a></span> --}}
                        {{-- <span class="question-view"><i class="icon-user"></i>70 views</span> --}}
                        <div class="clearfix"></div>
                    </div>
                </article>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection