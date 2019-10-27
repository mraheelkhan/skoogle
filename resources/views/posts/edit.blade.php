@extends('layouts.home');
@section('content')
<section class="blog_tow_area">
    <div class="container">
       <div class="row blog_tow_row">
            <div class="col-md-8">
                    @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                    @endif
            <form action="{{route('PostUpdate')}}" method="post">
                @csrf
            <input type="hidden" value="{{$data->id}}" name="post_id"/>
                <div class="form-group">
                    <label for="title"> Enter title of the post</label>
                    <input type="text" class="form-control input_box" name="title" id="title" placeholder="Enter Title of the Post" value="{{!old('title')?$data->post_title : old('title')}}" onchange="urlGenerator()" focused/>
                </div>
                <div class="form-group">
                    <label for="title"> Url (none-editable)</label>
                    <input type="text" class="form-control input_box" name="post_url" id="post_url" value="{{!old('post_url')?$data->post_url : old('post_url')}}" placeholder="URL of the Post" readonly/>
                </div>
                <div class="form-group">
                    <label for="title"> Select Category</label>
                    <select  name="category_id" id="category_id" class="form-control">
                        <option value="" disabled selected>Select Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                            @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="title"> Your Post Content</label>
                    <textarea rows="10"  cols="10"  value="{{ old('post_content')}}" class="" name="post_content" id="post_content">
                            {{!old('post_content')?$data->post_content : old('post_content')}}
                        </textarea>
                    <script>
                            CKEDITOR.replace( 'post_content' );
                        </script>
                        
                </div>
                <div class="form-group">
                        <label for="title"> Allowed Comment?</label>
                        <select name="is_comment" id="is_comment"  value="{{ old('is_comment')}}" class="form-control">
                            <option value="1"> Allowed </option>
                            <option value="0"> Not Allowed </option>
                        </select>
                    </div>

                    <div class="form-group">
                        <input type="submit" name="submit" value="Publish Post" class="btn btn-primary"/>
                    </div>
            </form>

            </div>
       </div>
    </div>
</section>

<script>
    function urlGenerator(){
        var title = $('#title').val();
        var random = Math.floor(Math.random() * 1000000) + 1000000;
        title = title.replace(/[^a-zA-Z0-9]/g, '-');
        //title = title.replace(/[^a-zA-Z ]/g, "-");
        var newUrl = $('#post_url').val(title + random);
        console.log(title + random);
    }
</script>
@endsection