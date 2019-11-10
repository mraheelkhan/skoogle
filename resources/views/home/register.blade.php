@extends('layouts.home')
@section('content')
<section id="signup-new" style="background: url('{{asset("public/img/backgroundimg.jpg")}}');margin: -170px -60px;background-size: cover;background-position: center;">
    <div class="row">       
    <div class="register-right">

    <div class="sign-up-form1">
        <img src="{{ asset('public/img/avat.png') }}" class="avatar">
        <h1> Sign Up Now</h1>
        @if ($errors->any())
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
        @endif
        <form action="{{ route('RegisterStore') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <input type="text" name="fname" class="input-box" placeholder="First Name" value="{{old('fname')}}" required>
            </div>
            <div class="form-group">
                <input type="text" name="lname" value="{{old('lname')}}" class="input-box" placeholder="Last Name" required>
            </div>
            
            <div class="form-group">
                <input type="phone" name="phone" value="{{old('phone')}}" class="input-box" placeholder="Your Phone" required>
            </div>
            <div class="form-group">
                <input type="file" name="image" value="{{old('image')}}" class="input-box" required>
            </div>
            <div class="form-group">
                <label for="gender"> Gender</label>
                <select name="gender" id="gender">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">other</option>
                </select>
            </div>
            <div class="form-group">
                <input type="email" name="email" value="{{old('email')}}" class="input-box" placeholder="Your Email" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" class="input-box" placeholder="Your Password" required>
            </div>
                        
            <button type="submit" name='submit' class="btn btn-primary">Sign Up</button>
            <hr>
            <p class="or">OR</p>
            {{-- <a href="{{ url('/login') }}" class="login-btn">Login with Twitter</a> --}}
            <p>Do you have an account? <a href="{{ url('/login') }}">Sign In</a></p>
        </form>
    </div>
    
        
    
    </div>
        
    </div>
        </section>
    
@endsection