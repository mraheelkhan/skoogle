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
            <form action="{{route('CourseStore')}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="title"> Enter title of the course</label>
                <input type="text" class="form-control input_box" name="title" id="title" placeholder="Enter Title of the Post" value="{{ old('title')}}" onchange="urlGenerator()" focused/>
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
                    <label for="title"> Your Course Content</label>
                    <textarea rows="10"  cols="10"  value="{{ old('description')}}" class="" name="description" id="description"></textarea>
                    <script>
                            CKEDITOR.replace( 'description' );
                        </script>
                        
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