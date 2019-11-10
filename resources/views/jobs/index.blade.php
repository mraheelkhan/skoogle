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
{{-- <div class="site-section">
        <div class="container">
          <div class="row">
            <div class="col-md-6 mx-auto text-center mb-5 section-heading">
              <h2 class="mb-5">Popular Categories</h2>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6 col-md-4 col-lg-3 mb-3" data-aos="fade-up" data-aos-delay="100">
              <a href="#" class="h-100 feature-item">
                <span class="d-block icon flaticon-calculator mb-3 text-primary"></span>
                <h2>Accounting / Finanace</h2>
                <span class="counting">10,391</span>
              </a>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3 mb-3" data-aos="fade-up" data-aos-delay="200">
              <a href="#" class="h-100 feature-item">
                <span class="d-block icon flaticon-wrench mb-3 text-primary"></span>
                <h2>Automotive Jobs</h2>
                <span class="counting">192</span>
              </a>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3 mb-3" data-aos="fade-up" data-aos-delay="300">
              <a href="#" class="h-100 feature-item">
                <span class="d-block icon flaticon-worker mb-3 text-primary"></span>
                <h2>Construction / Facilities</h2>
                <span class="counting">1,021</span>
              </a>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3 mb-3" data-aos="fade-up" data-aos-delay="400">
              <a href="#" class="h-100 feature-item">
                <span class="d-block icon flaticon-telecommunications mb-3 text-primary"></span>
                <h2>Telecommunications</h2>
                <span class="counting">1,219</span>
              </a>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3 mb-3" data-aos="fade-up" data-aos-delay="500">
              <a href="#" class="h-100 feature-item">
                <span class="d-block icon flaticon-stethoscope mb-3 text-primary"></span>
                <h2>Healthcare</h2>
                <span class="counting">482</span>
              </a>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3 mb-3" data-aos="fade-up" data-aos-delay="600">
              <a href="#" class="h-100 feature-item">
                <span class="d-block icon flaticon-computer-graphic mb-3 text-primary"></span>
                <h2>Design, Art &amp; Multimedia</h2>
                <span class="counting">5,409</span>
              </a>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3 mb-3" data-aos="fade-up" data-aos-delay="700">
              <a href="#" class="h-100 feature-item">
                <span class="d-block icon flaticon-trolley mb-3 text-primary"></span>
                <h2>Transportation &amp; Logistics</h2>
                <span class="counting">291</span>
              </a>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3 mb-3" data-aos="fade-up" data-aos-delay="800">
              <a href="#" class="h-100 feature-item">
                <span class="d-block icon flaticon-restaurant mb-3 text-primary"></span>
                <h2>Restaurant / Food Service</h2>
                <span class="counting">329</span>
              </a>
            </div>
          </div>
  
        </div>
      </div> --}}


      <div class="site-section bg-light">
            <div class="container">
              <div class="row">
                <div class="col-md-12 mb-5 mb-md-0" data-aos="fade-up" data-aos-delay="100">
                  <h2 class="mb-5 h3">Recent Jobs</h2>
                  <div class="rounded border jobs-wrap">
      
                    @foreach($jobs as $job)
                  <a href="{{ route('JobShow', $job->id)}}" class="job-item d-block d-md-flex align-items-center  border-bottom fulltime" style="{{ ($job->status == 2) ? 'background: #d40606;' : ''}}">
                      
                      <div class="job-details h-100">
                        <div class="p-3 align-self-center">
                        <h3>{{ $job->job_title }}</h3>
                          <div class="d-block d-lg-flex">
                            <div class="mr-3"><span class="icon-suitcase mr-1"></span> {{ $job->organization->deptname }}</div>
                            <div class="mr-3"><span class="icon-room mr-1"></span> {{ $job->job_location }}</div>
                            <div><span class="icon-money mr-1"></span> PKR {{ $job->salary_range }}</div>
                          </div>
                        </div>
                      </div>
                      <div class="job-category align-self-center">
                        <div class="p-3">
                          
                        <span class="text-@if($job->job_type == 'fulltime')info @elseif($job->job_type == 'freelance')warning @elseif($job->job_type == 'parttime')danger @endif p-2 rounded border border-@if($job->job_type == 'fulltime')info @elseif($job->job_type == 'freelance')warning @elseif($job->job_type == 'parttime')danger @endif">{{ ucfirst($job->job_type) }}</span>
                        
                        </div>
                        @if(auth()->check() && $job->user_id == auth()->user()->id && $job->status != 2 && auth()->user()->organization_id != 0)
                        <div class="p-3">
                        <span onclick="jobMarkAsClosed({{ $job->id }})" class="text-primary p-2 rounded border filled border-primary"> 
                          <i class="fas fa-trash-alt"></i>Close Job
                        </span>
                        </div>
                        @endif
                        {{ ($job->status == 2) ? 'CLOSED' : ''}}
                        
                       
                      </div>  
                    </a>
                    @endforeach
      
                    
      
                  </div>
      
                  {{-- <div class="col-md-12 text-center mt-5">
                    <a href="#" class="btn btn-primary rounded py-3 px-5"><span class="icon-plus-circle"></span> Show More Jobs</a>
                  </div> --}}
                </div>

      
                </div>
              </div>
            </div>
          </div>

  <script>
  function jobMarkAsClosed(id){
    event.preventDefault();
    routeURL = "{{ route('JobMarkAsClosed') }}";
    $.ajax({
        url: routeURL,
        method: 'POST',
        data: {
            "job_id" : id,
            "_token" : "{{csrf_token()}}"
        },
        success: function(data){
            console.log(data);
            if(data.success == 1){
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
    </script>
@endsection