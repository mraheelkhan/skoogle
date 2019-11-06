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
            <form action="{{route('CourseVideoStore')}}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="course_id" value="{{ $course_id }}"/>
                <div class="form-group">
                    <label for="title"> Enter title of the course video</label>
                <input type="text" class="form-control input_box" name="title" id="title" placeholder="Enter Title of the Post" value="{{ old('title')}}" onchange="urlGenerator()" focused/>
                </div>
                <div class="form-group">
                    <label for="file"> Upload Video File</label>
                <input type="file" class="form-control input_box" name="file" id="file"/>
                </div>

                <div class="form-group">
                    <label for="title"> Your video Content</label>
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


@endsection