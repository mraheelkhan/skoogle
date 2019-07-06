<?php

namespace App\Http\Controllers;

use App\Job;
use App\Category;
use DataTables;
use Illuminate\Http\Request;
use Session;
use Auth;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobs = Job::where('status', 1)->where('isActive', 1)->where('is_deleted', 0)->with('organization')->get();
        return view('jobs.index', compact('jobs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if( auth()->user()->organization_id == 0){
            Session::flash('error', 'You do not have any organization. <script>swal.fire("No Organization","You do not have a organization", "warning");</script>'); 
            return redirect()->back();
        }
        $categories = Category::where('type', 'job')->where('is_deleted', 0)->get();
        return view('jobs.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $validated = $request->validate([   
            "job_title" => 'required|min:20|max:100',
            "job_type" => 'required',
            "job_location" => 'min:4|max:200',
            "salary_range" => 'required',
            "deadline" => 'date|after:today',
            "category_id" => 'required',
            "job_description" => 'required|min:50|max:3000'
        ]);
        
        $insert = Job::create([
            'job_title' => request('job_title'),
            'job_type' => request('job_type'),
            'job_location' => request('job_location'),
            'deadline' => request('deadline'),
            'salary_range' => request('salary_range'),
            'category_id' => request('category_id'),
            'description' => request('job_description'),
            'user_id' => auth()->user()->id,
            'organization_id' => auth()->user()->organization_id,
        ]);

        Session::flash('message', 'Your job is posted successfully. <script>swal.fire("success","Posted","Your job is posted successfully");</script>'); 
        return redirect(route('JobAll'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $job = Job::findOrFail($id);
        return view('jobs.show')->with('job', $job);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function edit(Job $job)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Job $job)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function destroy(Job $job)
    {
        //
    }

    public function myPostedJobs(){
        $myJobs = 0;
        $jobs = Job::where('user_id', auth()->user()->id)->where('isActive', 1)->where('is_deleted', 0)->with('organization')->get();
        return view('jobs.index', compact('jobs', 'myJobs'));
    }

    public function markAsClosed(Request $request){
        $id= $request->job_id;
        $job = Job::findOrFail($id);
        $job->status = 2; // status closed
        $job->update();
        // return redirect()->back();
        $success = 1;
        $message = "job marked as closed";
        $array = array( 
                'msg' => $message,
                'success' => $success
            );
        return response($array);
    }

    public function admin_all(){
        $categories = Category::all();
        return view('jobs.indexAdmin', compact('categories'));
    }

    public function adminfetch(){
        $data = Job::orderBy('id','desc')->get();
        return DataTables::of($data)
        ->addColumn('created_at',function($data){
            return $data->created_at->format('Y-m-d');
        })
        ->addColumn('job_title',function($data){
            return $data->job_title;
        })
        ->addColumn('category_name',function($data){
            return ucwords($data->category->category_name);
        })
        ->addColumn('organization',function($data){
            return ucwords($data->organization->deptname);
        })
        ->addColumn('user_id',function($data){
            return $data->user->fname . " " . $data->user->lname;
        })  
        ->addColumn('status',function($data){
          if($data->status== 0) {
            return '<span class="label label-danger">Pending</span>';
          }else if($data->status== 1){
            return '<span class="label label-success">Posted</span>';
          }
            else if($data->status== 2){
            return '<span class="label label-danger">Closed </span>';
          }
            else if($data->status== 3){
            return '<span class="label label-success">Marked as Solved </span>';
          }
          else{
            return '<span class="label  label-primary">'.$data->status.'</span>';
          }
        })

        ->addColumn('options',function($data){
            if($data->isActive == 1 || $data->status == 2 || $data->status == 3){
            return "&emsp;
                                     <a data-toggle='tooltip' data-placement='bottom' title='Disable' class='btn btn-info disable' data-original-title='Disable' href='#' data-id='".$data->id."'><i class='fa fa-close'></i></a>
                                     ";
            }else if($data->isActive == 0){
             return "&emsp;
                                     <a data-toggle='tooltip' data-placement='bottom' title='Active' class='btn btn-success active' data-original-title='Active' href='#' data-id='".$data->id."'><i class='fa fa-check'></i></a>
                                     "; 
            }                         
        })
     
        ->rawColumns(['created_at','job_title', 'category_name', 'organization', 'user_id', 'status','options'])
        ->make(true);
    }



    public function adminActive(Request $request)
    {
      $data = Job::findOrFail($request->id);
      $data->isActive = 1;
      $data->update();
      $message = 'Successfully Active.';
      return response()->json($message);
    }
     
    public function adminDisable(Request $request)
    {
      $data = Job::findOrFail($request->id);
      $data->isActive = 0;
      $data->update();
      $message = 'Successfully Disable.';
      return response()->json($message);
    }

    public function adminDelete(Request $request)
    {
      $data = Job::findOrFail($request->id);
      $data->is_deleted = 1;
      $data->update();
      $message = 'Successfully Deleted.';
      return response()->json($message);
    }

    
}
