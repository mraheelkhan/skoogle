@extends('layouts.home');
@section('content')
<section class="blog_tow_area">
    <div class="container">
       <div class="row blog_tow_row">
            {{-- <div class="col-md-4 col-sm-6">
                <div class="renovation">
                    <img src="images/blog/renovation/r-1.jpg" alt="">
                    <div class="renovation_content">
                        <a class="clipboard" href="#"><i class="fa fa-clipboard" aria-hidden="true"></i></a>
                        <a class="tittle" href="adobe.html">What is Adobe &amp; how it works?</a>
                        <div class="date_comment">
                            <a href="#"><i class="fa fa-calendar" aria-hidden="true"></i>October 2nd, 2019</a>
                            <a href="#"><i class="fa fa-commenting-o" aria-hidden="true"></i>3</a>
                        </div>
                        <p>Get access to all adobe tools &amp; hands on all the features.</p>
                    </div>
                </div>
            </div> --}}
            <div class="col-md-8">
                    @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                    @endif
            <form action="{{route('PostStore')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="title"> Enter title of the post</label>
                <input type="text" class="form-control input_box" name="title" id="title" placeholder="Enter Title of the Post" value="{{ old('title')}}" onchange="urlGenerator()" focused/>
                </div>
                <div class="form-group">
                    <label for="title"> Url (none-editable)</label>
                    <input type="text" class="form-control input_box" name="post_url" id="post_url" value="{{ old('post_url')}}" placeholder="URL of the Post" readonly/>
                </div>
                <div class="form-group">
                    <label for="image"> Upload Image</label>
                <input type="file" class="form-control input_box" name="image" id="image" onchange="readURL(this);" />
                <img id="imagePreview" src="http://placehold.it/180" alt="your image" style="display:none; width:100%; height: 100%" />    
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
                    <textarea rows="10"  cols="10"  value="{{ old('post_content')}}" class="" name="post_content" id="post_content"></textarea>
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

    function readURL(input) {
        $('#imagePreview').show();
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#imagePreview')
                    .attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection