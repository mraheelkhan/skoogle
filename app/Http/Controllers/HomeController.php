<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use DateTime;
use DatePeriod;
use DateInterval;
use Calendar;
use App\Post;
use App\Job;
use App\Project;
use App\Service;
use Carbon\Carbon;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('newsfeed');
        //$this->middleware('customer');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return view('dashboard');
        return redirect()->route('dashboard');
    }

    public function dashboard()
    {
        return view('dashboard');
        
    }

    public function newsfeed(){
        $posts = Post::where('is_deleted', 0)->get();
        $post = Post::latest('created_at')->first();

        $jobs = Job::where('is_deleted', 0)->where('status', 1)->get();
        $projects = Project::where('is_deleted', 0)->where('status', 1)->get();
        $services = Service::where('is_deleted', 0)->where('status', 1)->get();
        return view('home.home', compact('posts', 'post', 'jobs', 'projects', 'services' ));
    }

    
}
