<?php

namespace App\Http\Controllers;

use App\Service;
use App\Category;
use App\User;
use Session;
use Auth;
use DB;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->except(['show', 'index']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::where('is_deleted', 0)->get();
        return view('services.index', compact('services'));
    }

    public function myServices(){
        
        $services = Service::where('user_id', auth()->user()->id)->orderBy('id', 'desc')->where('is_deleted', 0)->get();
        // dd($services);
        return view('services.my_services', compact('services'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(auth()->user()->isPro != 1){
            return "You are not authorize";
        }
        $categories = Category::where('type', 'service')->get();
        return view('services.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([   
            "category_id" => 'required|numeric',
            "description" => 'required|min:100',
            "title" => 'required|max:200',
            "url" => 'required|unique:services',
        ]);
        $service = new Service;
        $service->user_id = auth()->user()->id;
        $service->category_id = $request->category_id;
        $service->description = $request->description;
        $service->price = $request->price;
        $service->title = $request->title;
        $service->url = $request->url;

        $service->save();
        Session::flash('message', 'Your service is posted successfully. <script>swal.fire("success","Posted","Your service is posted successfully");</script>'); 
        return redirect(route('ServiceMy'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show($url)
    {
        $service = Service::where('url', $url)->first();
        return view('services.show', compact('service'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $service = Service::findOrFail($id);
        if(auth()->user()->id != $service->user_id){
            Session::flash('message', 'This service does not belongs to you. <script>swal.fire("error","Not Deleted","This service does not belongs to you");</script>'); 
            return redirect()->back();
        } else {
            $service->is_deleted = 1;
            $service->update();

            Session::flash('message', 'Your service is deleted successfully. <script>swal.fire("success","Posted","Your service is deleted successfully");</script>'); 
            return redirect()->back();
        }
    }
}