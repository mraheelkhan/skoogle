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
       <div class="row blog_tow_row">
            @if(auth()->check() && auth()->user()->isPro == 1)
            <div class="row blog_tow_row mb-5 text-center">
                <a href="{{ route('CourseVideoCreate', $course_id) }}" class="btn btn-primary">Add New Video</a>
            </div>
            @endif
            <div class="container" style="padding: 10px;">
              <p>
                {!!$course->description!!}
            </p>
            </div>
            @foreach($showcoursevideos as $video)
            <div class="col-md-4 col-sm-6">
                <div class="card">
                    <div class="card-body alert alert-success">
                            <div class="text-right">
                                    <a href="{{route('CourseVideoDelete', $video->id)}}" class="btn btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                    {{-- <a  href="{{route('CourseVideoEdit', $video->id)}}" class="btn btn-primary">
                                        <i class="fa fa-edit"></i>
                                    </a> --}}
                                </div>
                    <h4><a class="tittle" href="{{ route('CourseVideoShow', [str_replace(" ", "-",$video->course->title), $video->id]) }}">{{ $video->title }}</a></h4>
                    </div>
                </div>
            </div>
            @endforeach
       </div>
       <div class="">
                    
            <div class="col-md-offset-1 col-md-8">
                    <hr/>
                    
                    @if(auth()->check() && auth()->user()->id == $course->user_id )
                    <div class="row">
                      <div class="col-md-8">
                        <div class="table table-responsive p-5 bg-white">
                          <h2 class="mb-5"> List of User who Applied</h2>
                          <table class="table table-striped responsive">
                            <thead>
                              <tr>
                                <th>Id</th>
                                <th>User Name</th>
                                <th>Email</th>
                                <th>Date</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>
                              @php $index = 1; @endphp
                              @foreach($appliers as $apply)
                                <tr>
                                <td>{{ $index++ }}</td>
                                <td> <a href="{{route('ProfileUserAccount', $apply->user->id) }}">
                                    {{ $apply->user->fname }} {{ $apply->user->lname}} </a></td>
                                <td> {{ $apply->user->email }}</td>
                                  <td>{{ date('d-M-Y', strtotime($apply->created_at)) }}</td>
                                  <td><a  href="{{route('CourseUserEnroll', [$apply->user->id, $course->id])}}" class="btn btn-success">
                                    <i class="fa fa-plus"></i>
                                </a></td>
                                </tr>
                                @endforeach
                            </tbody>
                
                          </table>
                        </div>
                      </div>
                    </div>
                    @endif
            </div>
        </div>
    </div>
</section>
@endsection