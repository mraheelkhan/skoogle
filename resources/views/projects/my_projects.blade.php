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
        {{-- @if(auth()->check() && auth()->user()->isPro == 1) --}}
        @if(auth()->check())
        <h1 class="text-center">My Projects: {{ count($projects) }}</h1>
        <div class="row blog_tow_row mb-5 text-center">
            <a href="{{ route('ProjectCreate') }}" class="btn btn-primary">Create New Project</a>
        </div>
        @endif
       <div class="row blog_tow_row">
            @foreach($projects as $project)
            <div class="col-md-4 col-sm-6">
                <div class="renovation">
                    {{-- <img src="images/blog/renovation/r-1.jpg" alt=""> --}}
                    <div class="renovation_content @if($project->status == 2) bg-info @endif">
                            {{-- @if(auth()->check() && auth()->user()->isPro == 1 && auth()->user()->id == $project->user_id) --}}
                            @if(auth()->check() && auth()->user()->id == $project->user_id)
                            <div class="text-right">
                                    <a href="{{route('ProjectDelete', $project->id)}}" class="btn btn-danger" title="Delete Project">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                    @if($project->status == 2)
                                    <a onclick="projectMarkAsOpen({{$project->id}})" class="btn btn-green" title="Mark as Open">
                                            <i class="fa fa-check"></i>
                                        </a>
                                    @else
                                    <a onclick="projectMarkAsClosed({{$project->id}})" class="btn btn-green" title="Mark as Closed">
                                        <i class="fa fa-times"></i>
                                    </a>
                                    @endif
                                </div>
                            @endif
                        {{-- <a class="clipboard" href="#"><i class="fa fa-clipboard" aria-hidden="true"></i></a> --}}
                    <a class="tittle" href="{{ route('ProjectShow', $project->url) }}">{{ $project->title }} 
                            @if($project->status == 2) <span class="badge badge-info"> *Closed</span>@endif
                        </a>
                        <div class="date_comment">
                            <a href="#"><i class="fa fa-clock-o" aria-hidden="true"></i>{{ $project->end_date }}</a>
                            {{-- <a href="#"><i class="fa fa-commenting-o" aria-hidden="true"></i>3</a> --}}
                        </div>
                        <p>{!! substr($project->description,0,100)!!}</p> 
                    </div>
                    
                </div>
            </div>
            <script>
                    function projectMarkAsClosed(id){
                      event.preventDefault();
                      routeURL = "{{ route('ProjectMarkAsClosed') }}";
                      $.ajax({
                          url: routeURL,
                          method: 'POST',
                          data: {
                              "project_id" : id,
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
                    function projectMarkAsOpen(id){
                      event.preventDefault();
                      routeURL = "{{ route('ProjectMarkAsOpen') }}";
                      $.ajax({
                          url: routeURL,
                          method: 'POST',
                          data: {
                              "project_id" : id,
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
            @endforeach
       </div>
    </div>
</section>
@endsection