@extends('layouts.job')
@section('content')
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

<div class="site-section bg-light">
  <div class="container">
    <div class="row">
    
      <div class="col-md-12 col-lg-8 mb-5">
      
        
      
        <div class="p-5 bg-white">

          <div class="mb-4 mb-md-5 mr-5">
            <div class="job-post-item-header d-flex align-items-center">
              <h2 class="mr-3 text-black h4" > {{ $job->job_title }}  </h2>
              <div class="badge-wrap">
              <span class="border border-@if($job->job_type == 'fulltime')info @elseif($job->job_type == 'freelance')warning @elseif($job->job_type == 'parttime')danger @endif text-@if($job->job_type == 'fulltime')info @elseif($job->job_type == 'freelance')warning @elseif($job->job_type == 'parttime')danger @endif py-2 px-4 rounded">{{ ucfirst($job->job_type) }}</span>
              </div>
            </div>
            <div class="job-post-item-body d-block d-md-flex">
              <div class="mr-3"><span class="fl-bigmug-line-portfolio23"></span> 
              <a href="#">{{ $job->organization->deptname }}</a>
              </div>
              <div><span class="fl-bigmug-line-big104"></span>
                <span >{{ $job->job_location }} {{ $job->created_at->diffForHumans()}}</span>
              </div>
              @if($job->status == 2)
              <div>
                <span class="border border-danger py px-3 rounded">JOB CLOSED</span>
              </div>
              @endif
            </div>
          </div>
          <p>{{ $job->description }}</p>

          @if(auth()->check())
          <p class="mt-5">
              @if($job->status == 2  || auth()->user()->id == $job->user_id )
              
              @else
              <a href="#"  data-toggle="modal" data-target="#exampleModal" class="btn btn-primary  py-2 px-4">Apply Job</a>
              @endif
          </p>
          @else
              <p class="mt-5">
              <a href="{{ route('login') }}" class="btn btn-danger py-2 px-4">Login to Apply Job</a>
              </p>
          @endif
        </div>
      </div>

      <div class="col-lg-4">
        
        
        <div class="p-4 mb-3 bg-white">
          <h3 class="h5 text-black mb-3">More Info</h3>
          <h4 class="h4 text-black mb-2"> {{ $job->deadline }} </h4>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsa ad iure porro mollitia architecto hic consequuntur. Distinctio nisi perferendis dolore, ipsa consectetur</p>
          
          
          @if(auth()->check())
          <p class="mt-5">
                  @if($job->status == 2 || auth()->user()->id == $job->user_id )
              
                  @else
                  <a href="#" data-toggle="modal" data-target="#exampleModal" class="btn btn-primary  py-2 px-4">Apply Job</a>
                  @endif
          </p>
          @else
              <p class="mt-5">
              <a href="{{ route('login') }}" class="btn btn-danger py-2 px-4">Login to Apply Job</a>
              </p>
          @endif
        </div>
      </div>
    </div>
    @if(auth()->check() && auth()->user()->id == $job->user_id )
    <div class="row">
      <div class="col-md-8">
        <div class="table-responsive p-5 bg-white">
          <h2 class="mb-5"> List of People who Applied</h2>
          <table class="table table-striped responsive">
            <thead>
              <tr>
                <th>Id</th>
                <th>User Name</th>
                <th>CV File</th>
                <th>Salary</th>
                <th>Date</th>
              </tr>
            </thead>
            <tbody>
              @php $index = 1; @endphp
              @foreach($appliers as $apply)
                <tr>
                <td>{{ $index++ }}</td>
                <td>{{ $apply->user->fname }} {{ $apply->user->lname}} </td>
                  <td> <a target="_blank" href="{{ asset('public/cv/'.$apply->cv_file_name) }}"> Download Cv</a></td>
                <td> {{ $apply->salary_expected }}</td>
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

      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Apply for - {{$job->job_title}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
              <form action="{{route('JobApply')}}" method="POST"method="post" enctype="multipart/form-data" role="form">
                @csrf
                <input type="hidden" name="job_id" value="{{$job->id}}"/>
                  <div class="form-group">
                    <label for="salary_expected">Expected Salary</label>
                    <input type="number" name="salary_expected" id="salary_expected" class="form-control"/>
                  </div>
                  <div class="form-group">
                    <label for="cv_file_name">Upload CV</label>
                    <input type="file" name="cv_file_name" id="cv_file_name" class="form-control"/>
                    {{-- <input id="cv_file_name" name="cv_file_name" type="file"> --}}
                  </div>
                  <div class="form-group">
                    <label for="cover_letter">Cover Letter</label>
                    <textarea rows="5" name="cover_letter" class="form-control"></textarea>
                  </div>
               
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
              </div>
            </div>
          </form>
          </div>
        </div>
        
      @endsection