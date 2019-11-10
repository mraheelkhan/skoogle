@extends('layouts.home')
@section('content')

<section class="serviceoffer">
    {{-- <div class="container">
        <div class="row service_skill">
            <div class="service_test"> 
        
            <p>READY TO OFFER YOUR SKILLS?</p>
            <p>Earn 10 skoogle coins & unlock the Matching Game by posting your first service. Not sure what to offer? <a href="#">Take our skill test</a></p> 
            </div>
            <div class="service_offer">
                <li><a href="#">Offer a Service</a></li>
            </div>
            </div>
        </div>
    </div> --}}
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
                        <div class="col-sm-6">
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

                           
                        </div>

                     <div class="col-sm-6 right">
                            <i class="fa fa-diamond" aria-hidden="true"></i>
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
                            </div><hr>

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
            <hr>

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
    
@endsection