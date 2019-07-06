@extends('layouts.job')
@section('content')
@if(session('message'))
    <script>
      $( document ).ready(function() {
        swal.fire("message", "{{session('message')}}", "success");
      });
    </script>
@endif
@if(session('failed'))
    <script>
      $( document ).ready(function() {
        swal.fire("Failed", "{{session('failed')}}", "error");
      });
      
    </script>
@endif

<div class="site-section bg-light">
        <div class="container">
          <div class="row">
<div class="col-md-12 col-lg-8 mb-5">
          
            
          
        <form action="{{ route('JobStore') }}" method="POST" class="p-5 bg-white">
          
          @csrf 

          <div class="row form-group">
                @if ($errors->any())
                <ul class="btn btn-danger">
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            @endif
            <div class="col-md-12 mb-3 mb-md-0">
              <label class="font-weight-bold" for="job_title">Job Title</label>
              <input type="text" id="job_title" name="job_title" class="form-control" placeholder="eg. Full Stack Frontend">
            </div>
          </div>

          <div class="row form-group">
            <div class="col-md-12"><h3>Job Type</h3></div>
            <div class="col-md-12 mb-3 mb-md-0">
              <label for="job_type1">
                <input type="radio" id="job_type1" name="job_type" value="fulltime"> Full Time
              </label>
            </div>
            <div class="col-md-12 mb-3 mb-md-0">
              <label for="job_type2">
                <input type="radio" id="job_type2" name="job_type" value="parttime"> Part Time
              </label>
            </div>

            <div class="col-md-12 mb-3 mb-md-0">
              <label for="job_type3">
                <input type="radio" id="job_type3" name="job_type" value="freelance"> Freelance
            </div>

          </div>

          <div class="row form-group mb-4">
            <div class="col-md-12"><h3>Job Area</h3></div>
            <div class="col-md-12 mb-3 mb-md-0">
              <select name="category_id" id="category_id" class="form-control">
                  <option value="" disabled selected> None </option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id}}"> {{ $category->category_name }} </option>
                    @endforeach
              </select>
            </div>
          </div>
          <div class="row form-group mb-4">
            <div class="col-md-12"><h3>Deadline Date</h3></div>
            <div class="col-md-12 mb-3 mb-md-0">
              <input type="date" class="form-control" id="deadline" name="deadline" placeholder="">
            </div>
          </div>
          <div class="row form-group mb-4">
            <div class="col-md-12"><h3>Location</h3></div>
            <div class="col-md-12 mb-3 mb-md-0">
              <input type="text" class="form-control" id="job_location" name="job_location" placeholder="Enter Location">
            </div>
          </div>
          <div class="row form-group mb-4">
            <div class="col-md-12"><h3>Salary Range</h3></div>
            <div class="col-md-12 mb-3 mb-md-0">
              <input type="text" class="form-control" id="salary_range" name="salary_range" placeholder="Enter Salary Range PKR 200 - 300">
            </div>
          </div>

          <div class="row form-group">
            <div class="col-md-12"><h3>Job Description</h3></div>
            <div class="col-md-12 mb-3 mb-md-0">
              <textarea name="job_description" class="form-control" id="job_description" cols="30" rows="5"></textarea>
            </div>
          </div>

          <div class="row form-group">
            <div class="col-md-12">
              <input type="submit" value="Post a Job" class="btn btn-primary  py-2 px-5">
            </div>
          </div>


        </form>
      </div>

      
    </div>
  </div>
</div>

@endsection