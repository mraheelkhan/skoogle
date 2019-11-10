@extends('layouts.home');
@section('content')
<section class="blog_all">
        <div class="container">
            <div class="row m0 blog_row">
                <div class="col-sm-8 main_blog">
                    {{-- <img src="{{ asset('public/uploads/postImages/' . $service->image) }}" alt=""> --}}
                    <div class="col-xs-1 p0">
                       <div class="blog_date">
                          {{-- <a> {{ date("d-M", strtotime($service->created_at)) }}</a> --}}
                       </div>
                    </div>
                    <div class="col-xs-11 blog_content">
                        <a class="blog_heading" href="#">{{$service->title}} </a>
                        <a class="blog_admin" href="#"><i class="fa fa-user" aria-hidden="true"></i>{{$service->user->fname . " " . $service->user->lname}}</a>
                        <ul class="like_share">
                            <li>
                                <a href="#">
                                    <i class="fa fa-money" aria-hidden="true"></i>
                                    {{ $service->price }} - PKR
                                </a>
                            </li>
                            
                        </ul>
                        <p>
                            {!!$service->description!!}
                        </p>
                    </div>
                   
                </div>
                
            </div>
        </div>
    </section>
@endsection