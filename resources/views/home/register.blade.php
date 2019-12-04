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
                <input type="text" name="fname" class="form-control" placeholder="First Name" value="{{old('fname')}}" required>
            </div>
            <div class="form-group">
                <input type="text" name="lname" value="{{old('lname')}}" class="form-control" placeholder="Last Name" required>
            </div>
            
            <div class="form-group">
                <input type="phone" name="phone" value="{{old('phone')}}" class="form-control" placeholder="Your Phone" required>
            </div>
            {{-- <div class="form-group">
                <input type="file" name="image" value="{{old('image')}}" class="form-control" required>
            </div> --}}
            <div class="form-group">
                <select name="gender" id="gender" class="form-control">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">other</option>
                </select>
            </div>
            <div class="form-group">
                <input type="email" name="email" value="{{old('email')}}" class="form-control" placeholder="Your Email" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Your Password" required>
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