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
            <div class="col-lg-8 introduction">

                <form action="{{ route('ProfileUserEditAccountStore')}}" method="POST"  enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <input type="text" class="form-control input_box" name="fname" value="{{ $profile->fname }}"/>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control input_box" name="lname" value="{{ $profile->lname }}"/>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control input_box" name="address" value="{{ $profile->profile->address }}"/>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control input_box" name="phone" value="{{ $profile->phonenumber }}"/>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control input_box" name="description" value="{{ $profile->profile->description }}"/>
                    </div>  
                    <div class="form-group">
                            <input type="file" name="image" value="{{old('image')}}" class="form-control" required>
                        </div>  
                    <div class="form-group">
                            <button type="submit" name='submit' class="btn btn-primary">Sign Up</button>
                    </div>
                    <div class="form-group"></div>
                    <div class="form-group"></div>
                </form>
                {{-- <a href="#">View Profile |</a><a href="#"> Edit Profile</a> --}}
            
            </div>
            
            </div>
        </div>
        
    </div>
    
</section>
    
@endsection