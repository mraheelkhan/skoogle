@extends('layouts.home');
@section('content')
<style>
     .featured_gallery {
    padding-top: 60px;
}
     /* .featured_gallery:hover {
    padding-top: 60px;
    background: #333333;
} */
 .featured_gallery .gallery_iner {
    position: relative;
    overflow: hidden;
}
 .featured_gallery .gallery_iner img {
    max-width: 100%;
}
 .featured_gallery .gallery_iner .gallery_hover {
    position: absolute;
    top: 45%;
    left: 0;
    transform: translateY(-50%);
    right: 0;
    text-align: center;
    z-index: 2;
}
 .featured_gallery .gallery_iner:hover .gallery_hover a,  .featured_gallery .gallery_iner:focus .gallery_hover a {
    left: 0;
}
 .featured_gallery .gallery_iner .gallery_hover a {
    width: 200px;
    font: 400 14px/60px "Roboto", sans-serif;
    text-align: center;
    display: block;
    border-radius: 10px;
    background: #333333;
    color: #fff;
    position: relative;
    left: -100%;
    transition: all 300ms linear 0s;
    text-transform: uppercase;
    margin: 0 auto;
}
 .featured_gallery .gallery_iner .gallery_hover a {
    width: 200px;
    font: 400 14px/60px "Roboto", sans-serif;
    text-align: center;
    display: block;
    border-radius: 10px;
    background: #333333;
    color: #fff;
    position: relative;
    left: -100%;
    transition: all 300ms linear 0s;
    text-transform: uppercase;
    margin: 0 auto;
}


 .featured_gallery .gallery_iner .gallery_hover h4 {
    color: #000;
    font: 700 14px "Roboto", sans-serif;
    text-transform: uppercase;
    padding-bottom: 28px;
    position: relative;
    /* right: -100%; */
    transition: all 300ms linear 0s;
}
</style>
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
                    <div class="featured_gallery">
                    @foreach($categories as $category)
                    <div class="col-md-4 col-sm-4 col-xs-6 gallery_iner p0">
                            <img src="{{ asset('public/img/adobe.jpg')}}" alt=""  style="background:#333333; opacity:0.1">
                            <div class="gallery_hover">
                                <h4>{{ $category->category_name }}</h4>
                                <a href="#">VIEW PROJECT</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
       </div>
    </div>
</section>

@endsection