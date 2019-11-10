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
            <form action="{{route('ProjectStore')}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="title"> Enter title of the project</label>
                <input type="text" class="form-control input_box" name="title" id="title" placeholder="Enter Title of the Project" value="{{ old('title')}}" onchange="urlGenerator()" focused/>
                </div>
                <div class="form-group">
                    <label for="title"> Url (none-editable)</label>
                    <input type="text" class="form-control input_box" name="url" id="url" value="{{ old('url')}}" placeholder="URL of the Project" readonly/>
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
                    <label for="title"> Your Project Content</label>
                    <textarea rows="10"  cols="50"  value="{{ old('description')}}" class="" name="description" id="description"></textarea>
                    <script>
                            CKEDITOR.replace( 'description' );
                        </script>
                        
                </div>  
                <div class="form-group">
                    <label for="end_date"> Deadline </label>
                    <input type="date" class="form-control" name="end_date" id="end_date" />
                </div>

                <div class="form-group">
                    <input type="submit" name="submit" value="Publish Project" class="btn btn-primary"/>
                </div>
            </form>

            </div>
       </div>
    </div>
</section>

<script>
    $(document).ready(function() {
        $('#category_id').select2();
    });

    function urlGenerator(){
        var title = $('#title').val();
        var random = Math.floor(Math.random() * 1000000) + 1000000;
        title = title.replace(/[^a-zA-Z0-9]/g, '-');
        //title = title.replace(/[^a-zA-Z ]/g, "-");
        var newUrl = $('#url').val(title + random);
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