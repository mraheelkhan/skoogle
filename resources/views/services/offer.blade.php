@extends('layouts.home');
@section('content')
<section class="blog_tow_area">
    <div class="container">
       <div class="row blog_tow_row">

            <div class="col-md-8">
                    @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                    @endif
            
                    <div class="col-md-offset-4 col-md-6">
                        <img src="{{asset('public/img/test.png')}}"/>
                    </div>
                    <div class="col-md-offset-6 col-md-6">
                        <h2 class="text-center"> Offer your first Service</h2>
                        <p class="text-center"> Not sure what to offer?</p>
                        <p class="text-center">
                            <a href="{{ route('ServiceOfferCategory') }}"> Take our Skills Quiz</a>
                        </p>
                    </div>
            </div>
       </div>
    </div>
</section>

@endsection