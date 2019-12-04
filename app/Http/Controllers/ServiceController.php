<?php

namespace App\Http\Controllers;

use App\Service;
use App\Category;
use App\ServiceApplied;
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
        $services = Service::where('is_deleted', 0)->where('status', 1)->get();
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
            "image" => 'required',
        ]);
        if($request->hasFile('image')){

            $file = $request->file('image');
            $filename = time() . "-" . $file->getClientOriginalName();
            $path = public_path().'/uploads/serviceImages/';
            $file->move($path, $filename);
        }
        $service = new Service;
        $service->user_id = auth()->user()->id;
        $service->category_id = $request->category_id;
        $service->image = $filename;
        $service->description = $request->description;
        // $service->price = $request->price;
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
        $appliers = ServiceApplied::where('service_id', $service->id)->where('status', 1)->where('isActive', 1)->where('is_deleted', 0)->get();
        $ifApplied = ServiceApplied::where('service_id', $service->id)->where('user_id', auth()->user()->id)->get();
        // dd($ifApplied);
        return view('services.show', compact('service', 'appliers', 'ifApplied'));
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

    public function serviceOffer(){

        return view('services.offer');
    }

    public function serviceOfferCategory(){

        $categories = Category::where('type', 'test')->get();

        return view('services.offerCategory', compact('categories'));
    }

    public function apply(Request $request){

        $validated = $request->validate([   
            "service_id" => 'required',
        ]);

        $userid = auth()->user()->id;
        $service_id = $request->service_id;
        

        $insert = ServiceApplied::create([
            'service_id' => request('service_id'),
            'user_id' => auth()->user()->id,
        ]);

        Session::flash('message', 'You have applied successfully. <script>swal.fire("Applied","You have applied successfully", "success");</script>'); 
        return redirect()->back();
       
    }
    public function cancel($id){
        $applied = ServiceApplied::where('service_id', $id)->where('user_id', auth()->user()->id)->first();
        $applied->delete();

        return redirect()->back();
    }

    public function markAsClosed(Request $request){
        $id = $request->service_id;
        $service = Service::findOrFail($id);
        $service->status = 2; // status closed
        $service->update();
        // return redirect()->back();
        $success = 1;
        $message = "Service marked as closed";
        $array = array( 
                'msg' => $message,
                'success' => $success
            );
        return response($array);
    }
    public function markAsOpened(Request $request){
        $id = $request->service_id;
        $service = Service::findOrFail($id);
        $service->status = 1; // status closed
        $service->update();
        // return redirect()->back();
        $success = 1;
        $message = "Service marked as closed";
        $array = array( 
                'msg' => $message,
                'success' => $success
            );
        return response($array);
    }
}
