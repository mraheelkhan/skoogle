@extends('layouts.home')
@section('content')

<section class="serviceoffer">
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
</section>
<section class="mainaccount">
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <div class="mainprofile">
                  <img src="{{ asset('public/uploads/profiles/' . $profile->avatar) }}" alt="Avatar" style="width: 100%">
                     <h3>{{ $profile->fname . " " . $profile->lname }}  </h3>
                    <li>
                         <a href="#"><span>{{ $profile->profile->address }}</span></a>
                    </li>
                    <li>
                         <a href="{{ route('ProfileUserEditAccount', auth()->user()->id) }}" class="btn btn-primary">Edit Profile</a>
                    </li>
                    <ul>
                    {{-- <li>
                         <a href="">
                         <i class="fa fa-user-o" aria-hidden="true"></i>5 followers</a>
                    </li> --}}
                     </ul>
                     <hr>
                     {{-- <p>Verified: <a href="https://www.facebook.com/mohammad.abbas.75"><i class="fa fa-facebook-square" aria-hidden="true"></i></a>
                     <a href="https://www.linkedin.com/in/mohammad-abbas-kizilbash-591352154/"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a>
                     <a href="https://twitter.com/abbaskizilbash1"><i class="fa fa-twitter-square" aria-hidden="true"></i></a></p> --}}
                     <div class="row_badges">
                       

                     <div class="col-sm-6 right">
                            
                    </div>
                    
                    </div>

                     <!------<ul>

                </ul>----------->
            </div>

            </div>



            <div class="col-lg-8">
                {{-- <h4>Profile Strength: 1%</h4>
                <div class="progress">
                <div class="progress-bar" style="width: 3%;">1%</div> --}}
            </div>
            <hr>
            <div class="introduction">
                <h3>Hey, I'm {{ $profile->fname . " " . $profile->lname }}!</h3>
                <h5>{{ $profile->profile->address }} | Member {{ $profile->created_at->diffForHumans() }}</h5>
                <p> {{ $profile->profile->description }}</p>
                {{-- <a href="#">View Profile |</a><a href="#"> Edit Profile</a> --}}
            
            </div>
            {{-- <hr> --}}
            {{-- <div class="interest">
                <h4>Looking for:</h4>
                <a href="#">Add Interests</a>
            </div> --}}
            <hr>
            <div class="provide-service">
                <h4>Offered Services</h4>
                {{-- <p>Not sure what to offer? <a href="#">Take our skill test</a></p> --}}
                <div class="">
                    @foreach($services as $service)
                    <div class="col-md-2" style="border: 1px solid #000;">
                            <a href="{{ route('ServiceShow', $service->url)}}"> {{ $service->title }}</a>
                    </div>
                    @endforeach
                </div>
                @if(auth()->check() && $profile->id == auth()->user()->id)
                <div class="service-box">
                    <ul><i class="fa fa-plus-circle" style="font-size: 24px"></i>
                    <a href="{{ route('ServiceCreate')}}">Add Service</a>
                  </ul>
                    
                </div>
                @endif
            </div>
            
            <hr/>

            @if(count($certificates) > 0)
            <div class="provide-service">
                    <div class="">
                            <h4>Uploaded Certificates</h4>
                            @foreach($certificates as $certify)
                            <div class="col-md-4" style="border: 1px solid #000;">

                                <img width="100%" src="{{asset('public/uploads/certificates/' . $certify->filename)}}"/>
                                    <a href="{{ route('ServiceShow', $certify->id)}}"> {{ $certify->title }}</a>
                            </div>
                            @endforeach
                        </div>
            </div>
            <hr/>
            @else

            @endif

            <div class="col-md-8">
                @if(auth()->user()->isPro == 1)
            <h2> You are Professional </h2>
                @else
                <a href="{{ route('ProfileApplyPro', auth()->user()->id)}}" class="btn btn-success btn-lg"> Apply for Pro</a>
                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#certificates">
                        Upload Certificates
                      </button>
                @endif
            </div>
            {{-- <div class="requested-service">
                <h4>Requested Services</h4>
                <div class="service-box">
                    <ul><i class="fa fa-plus-circle" style="font-size: 24px"></i>
                   <a href="#">Add Request</a>
                  </ul>
                    
                </div>
            </div>    --}}
            </div>
        </div>
        
    </div>
  
    
    
</section>
<div class="modal fade" id="certificates" tabindex="-1" role="dialog" aria-labelledby="certificatesLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="certificatesLabel">Start New Chat</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                    <form action="{{ route('ProfileUploadCertificate')}}" method="POST"  enctype="multipart/form-data">
                        @csrf
                        
                        <div class="form-group">
                            <input type="text" placeholder="Enter title of certificate" class="form-control input_box" name="title"/>
                        </div>
                        <div class="form-group">
                                <input type="file" name="image" class="form-control" required>
                            </div>  
                        <div class="form-group">
                                <button type="submit" name='submit' class="btn btn-primary">Upload</button>
                        </div>
                        <div class="form-group"></div>
                        <div class="form-group"></div>
                    </form>
            </div>
            
          </div>
        </div>
      </div>

@endsection