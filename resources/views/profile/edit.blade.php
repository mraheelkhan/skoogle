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
                    <img src="{{ asset('public/uploads/profiles/' . $profile->avatar) }}" alt="Avatar" style="width: 100%">
                     <h3>{{ $profile->fname . " " . $profile->lname }}  </h3>
                    <li>
                         <a href="#"><span>{{ $profile->profile->address }}</span></a>
                    </li>
                    <ul>
                    
                     </ul>
                     <hr>
                     

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
                            <input type="file" name="image" value="{{old('image')}}" class="form-control">
                        </div>  
                    <div class="form-group">
                            <button type="submit" name='submit' class="btn btn-primary">Update Profile</button>
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