@extends('layouts.askme')
@section('topbanner')
<div class="breadcrumbs">
    <section class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Ask Question</h1>
            </div>
            <div class="col-md-12">
                <div class="crumbs">
                    <a href="#">Home</a>
                    <span class="crumbs-span">/</span>
                    <a href="#">Pages</a>
                    <span class="crumbs-span">/</span>
                    <span class="current">Ask Question</span>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@section('content')
<style>
    .form-inputs p {
        height: auto;
    }
    </style>
<div class="col-md-8">
				
    <div class="page-content ask-question" style="height: auto;">
        <div class="boxedtitle page-title"><h2>Ask Question</h2></div>
        @if(Session::has('message'))
            <p class="alert alert-success">{!! Session::get('message') !!}</p>
        @endif
        @if(Session::has('error'))
            <p class="alert alert-danger">{!! Session::get('error') !!}</p>
        @endif
        @if (count($errors) > 0)
            <div class="alert alert-danger" style="background: #ffbfbf; padding: 1px 20px;">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
            </div>
        @endif
        <p>Duis dapibus aliquam mi, eget euismod sem scelerisque ut. Vivamus at elit quis urna adipiscing iaculis. Curabitur vitae velit in neque dictum blandit. Proin in iaculis neque.</p>
        
        <div class="form-style form-style-3" id="question-submit">
        <form action="{{route('ForumStore')}}" method="post">
                @csrf
                <div class="form-inputs clearfix">
                    <p>
                        <label class="required">Question Title<span>*</span></label>
                    <input type="text" id="question-title" name="question_title"  value="{{ old('question_title')}}" placeholder="Enter question title here">
                        <span class="form-description">Please choose an appropriate title for the question to answer it even easier .</span>
                    </p>
                    <p>
                        <label class="required">Category<span>*</span></label>
                        <span class="styled-select">
                            <select name="category_id">
                                <option value="">Select a Category</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}"> {{$category->category_name}}</option>
                                @endforeach
                                
                            </select>
                        </span>
                        <span class="form-description">Please choose the appropriate section so easily search for your question .</span>
                    </p>
                    
                </div>
                <div id="form-textarea">
                    <p>
                        <label class="required">Details<span>*</span></label>
                        <textarea id="question-details" name="question_body"  aria-required="true" cols="58" rows="8">{{ old('question_body')}}</textarea>
                        <span class="form-description">Type the description thoroughly and in detail .</span>
                    </p>
                </div>
                <p class="form-submit" style="height: auto;">
                    <input type="submit" id="publish-question" value="Publish Your Question" class="button color small submit">
                </p>
            </form>
        </div>
    </div><!-- End page-content -->
</div>
              
@endsection