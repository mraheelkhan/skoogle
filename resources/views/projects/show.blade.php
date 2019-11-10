@extends('layouts.home');
@section('content')
<section class="blog_all">
        <div class="container">
            <div class="row m0 blog_row">
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
                    @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                    @endif
                <div class="col-sm-8 main_blog">
                    {{-- <img src="{{ asset('public/uploads/postImages/' . $project->image) }}" alt=""> --}}
                    <div class="col-xs-1 p0">
                       <div class="blog_date">
                          {{-- <a> {{ date("d-M", strtotime($project->created_at)) }}</a> --}}
                       </div>
                    </div>
                    <div class="col-xs-11 blog_content">
                        <a class="blog_heading" href="#">{{$project->title}} </a>
                        <a class="blog_admin" href="#"><i class="fa fa-user" aria-hidden="true"></i>{{$project->user->fname . " " . $project->user->lname}}</a>
                        <ul class="like_share">
                            <li>
                                <a href="#">
                                    <i class="fa fa-clock-o" aria-hidden="true"></i>
                                    {{ $project->end_date }} 
                                </a>
                            </li>
                            
                        </ul>
                        <p>
                            {!!$project->description!!}
                        </p>
                    </div>
                   
                </div>
                <div class="col-md-3">
                        @if(auth()->check())
                        <p class="mt-5">
                                @if(auth()->user()->id == $project->user_id )
                                <span class="alert alert-success"> 
                                    Your Project! </span>
                                    @if($project->status == 2)
                                    <span class="badge"> Status : Closed</span>
                                    @endif
                                </span>
                                    
                                @elseif($project->status == 2)
                                <span class="alert alert-info"> Project Closed!</span>
                                @else
                                    @if(count($ifApplied) < 1 )
                                        
                                        <form action="{{route('ProjectApply')}}" method="POST"method="post" enctype="multipart/form-data" role="form">
                                            @csrf
                                            <input type="hidden" name="project_id" value="{{$project->id}}"/>
                                            <input type="submit" class="btn btn-primary  py-2 px-4" value="Apply Project as Contributor" />
                                        </form>
                                    @else
                                        <span class="alert alert-success"> Already Applied!</span>
                                    @endif
                                @endif
                        </p>
                        @else
                            <p class="mt-5">
                            <a href="{{ route('login') }}" class="btn btn-danger py-2 px-4">Login to Apply Project</a>
                            </p>
                        @endif
                </div>

                <div class="">
                    
                    <div class="col-md-offset-1 col-md-8">
                            <hr/>
                            @if(auth()->check() && auth()->user()->id == $project->user_id )
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
                                      </tr>
                                    </thead>
                                    <tbody>
                                      @php $index = 1; @endphp
                                      @foreach($appliers as $apply)
                                        <tr>
                                        <td>{{ $index++ }}</td>
                                        <td>{{ $apply->user->fname }} {{ $apply->user->lname}} </td>
                                        <td> {{ $apply->user->email }}</td>
                                          <td>{{ date('d-M-Y', strtotime($apply->created_at)) }}</td>
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
            
        </div>
    </section>

@endsection