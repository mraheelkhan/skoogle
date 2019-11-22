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
                    {{-- <img src="{{ asset('images/profile.jpg" alt="Avatar"> --}}
                     <h3>{{ $profile->fname . " " . $profile->lname }}  </h3>
                    <li>
                         <a href="#"><span>{{ $profile->profile->address }}</span></a>
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
                        {{-- <div class="col-sm-6">
                           <i class="fa fa-trophy" aria-hidden="true"></i>
                           <div class="popup" onclick="myFunction()"><p>Quickster</p>
                              <span class="popuptext" id="myPopup">Members with this badge are among the quickest responders on Skoogle. Consistently reply in under 4 hours to earn and keep your Quickster badge.</span>
                            </div><hr>

                           <i class="fa fa-shield" aria-hidden="true"></i>
                           <div class="popup" onclick="myFunction()"><p>Veteran</p>
                              <span class="popuptext" id="myPopup">The veteran badge is reserved for experienced members with at least 3 deals.</span>
                            </div><hr>
                           <i class="fa fa-star-half-o" aria-hidden="true"></i>
                           <div class="popup" onclick="myFunction()"><p>Recruiter</p>
                              <span class="popuptext" id="myPopup">Recruiters are members that have got 5 or more members to join. Want to earn an awesome Recruiter Badge? Invite your friends to join Skoogle!</span>
                            </div><hr>
                           <i class="fa fa-star" aria-hidden="true"></i>
                           <div class="popup" onclick="myFunction()"><p>Helper</p>
                              <span class="popuptext" id="myPopup">How neighborly! Members with this badge have fulfilled another member’s request.</span>
                            </div><hr>

                           
                        </div> --}}

                     <div class="col-sm-6 right">
                            {{-- <i class="fa fa-diamond" aria-hidden="true"></i>
                            <div class="popup" onclick="myFunction()"><p>Circulator</p>
                              <span class="popuptext" id="myPopup">The coveted Circulator badge is awarded to members who invigorate the Symbiotic Economy by actively circulating substantial amounts of Skoogle.</span>
                            </div><hr>
                            <i class="fa fa-bolt" aria-hidden="true"></i>
                            <div class="popup" onclick="myFunction()"><p>Talented</p>
                              <span class="popuptext" id="myPopup">The talented badge is awarded to gifted members who have offered more than 5 services. The more you give, the more you get.</span>
                            </div><hr>
                            <i class="fa fa-empire" aria-hidden="true"></i>
                            <div class="popup" onclick="myFunction()"><p>Centurian</p>
                              <span class="popuptext" id="myPopup">his honorable badge is reserved for our most praiseworthy troops — those with 100 or more deals. Join the top ranks of the Symbiotic Economy.You’ll earn 100 for this achievement.</span>
                            </div><hr> --}}

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
                <p>Not sure what to offer? <a href="#">Take our skill test</a></p>
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