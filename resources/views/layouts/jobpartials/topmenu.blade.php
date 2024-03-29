<div class="site-navbar-wrap js-site-navbar bg-white">
      
    <div class="container">
        <div class="site-navbar bg-light">
        <div class="py-1">
            <div class="row align-items-center">
            <div class="col-2">
            <h2 class="mb-0 site-logo"><a href="{{ route('JobAll') }}"><img src="{{ asset('public/askme/images/logo.png') }}" alt=""></strong> </a></h2>
            </div>
            <div class="col-10">
                <nav class="site-navigation text-right" role="navigation">
                <div class="container">
                    <div class="d-inline-block d-lg-none ml-md-0 mr-auto py-3">
                        <a href="#" class="site-menu-toggle js-menu-toggle text-black">
                            <span class="icon-menu h3"></span></a></div>

                    <ul class="site-menu js-clone-nav d-none d-lg-block">
                        <li><a href="{{route('Home')}}">
                            <span class="">
                                <span class="icon-plus mr-3"></span> News Feed</span>
                            </a>
                        </li>
                        <li><a href="{{ route('JobAll') }}">All Jobs</a></li>
                        @if(auth()->check() && auth()->user()->organization_id != 0)
                        
                            @if(auth()->user()->isPro == 1 )
                            <li><a href="{{ route('MyPostedJobs') }}">My Posted Jobs</a></li>
                            @endif

                            @endif     
                            @if(auth()->user()->isPro == 1 ) 
                                <li><a href="{{route('JobCreate')}}">
                                    <span class="bg-primary text-white py-3 px-4 rounded">
                                        <span class="icon-plus mr-3"></span>Post New Job</span>
                                    </a>
                                </li>
                            @endif
                    </ul>
                </div>
                </nav>
            </div>
            </div>
        </div>
        </div>
    </div>
</div>
    
<div style="height: 113px;"></div>