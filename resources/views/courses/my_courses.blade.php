@extends('layouts.home')
@section('content')
<section class="blog_tow_area">
    <div class="container">
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
        @if(auth()->check() && auth()->user()->isPro == 1)
        <h1 class="text-center">My Courses: {{ count($showcourses) }}</h1>
        <div class="row blog_tow_row mb-5 text-center">
            <a href="{{ route('CourseCreate') }}" class="btn btn-primary">Create New Course</a>
        </div>
        @endif
       <div class="row blog_tow_row">
            @foreach($showcourses as $course)
            <div class="col-md-4 col-sm-6">
                <div class="renovation">
                    {{-- <img src="images/blog/renovation/r-1.jpg" alt=""> --}}
                    <div class="renovation_content  @if($course->status == 2) bg-info @endif">
                        <div class="text-right">
                                @if(auth()->check() && auth()->user()->isPro == 1 && auth()->user()->id == $course->user_id)
                                    <a href="{{route('CourseDelete', $course->id)}}" class="btn btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                    <a  href="{{route('CourseEnroll',  $course->id )}}" class="btn btn-primary">
                                        <i class="fa fa-plus"></i>
                                    </a>
                                    @endif
                                    @if($course->status == 2)
                                    <a onclick="courseMarkAsOpen({{$course->id}})" class="btn btn-green" title="Mark as Open">
                                            <i class="fa fa-check"></i>
                                        </a>
                                    @else
                                    <a onclick="courseMarkAsClosed({{$course->id}})" class="btn btn-green" title="Mark as Closed">
                                        <i class="fa fa-times"></i>
                                    </a>
                                    @endif
                                </div>
                        {{-- <a class="clipboard" href="#"><i class="fa fa-clipboard" aria-hidden="true"></i></a> --}}
                    <a class="tittle" href="{{ route('CourseShow', [str_replace(" ", "-", $course->category->category_name), $course->id]) }}">{{ $course->title }}</a>
                        <div class="date_comment">
                            <a href="#"><i class="fa fa-calendar" aria-hidden="true"></i>{{ $course->created_at }}</a>
                            <a href="#"><i class="fa fa-commenting-o" aria-hidden="true"></i>3</a>
                        </div>
                        <p>{!! substr($course->description,0,100)!!}</p> 
                    </div>
                    
                </div>
            </div>
            @endforeach
       </div>
    </div>
</section>
<script>
function courseMarkAsClosed(id){
                      event.preventDefault();
                      routeURL = "{{ route('CourseMarkAsClosed') }}";
                      $.ajax({
                          url: routeURL,
                          method: 'POST',
                          data: {
                              "course_id" : id,
                              "_token" : "{{csrf_token()}}"
                          },
                          success: function(data){
                              console.log(data);
                              if(data.success == 1){
                                  console.log("successfully marked as closed")
                                  swal.fire('Closed', 'Marked as Closed', "success");
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
                    function courseMarkAsOpen(id){
                      event.preventDefault();
                      routeURL = "{{ route('CourseMarkAsOpen') }}";
                      $.ajax({
                          url: routeURL,
                          method: 'POST',
                          data: {
                              "course_id" : id,
                              "_token" : "{{csrf_token()}}"
                          },
                          success: function(data){
                              console.log(data);
                              if(data.success == 1){
                                  console.log("successfully marked as open")
                                  swal.fire('Opened', 'Marked as open', "success");
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