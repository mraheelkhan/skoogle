<?php

namespace App\Http\Controllers;

use App\Project;
use App\User;
use App\Category;
use App\ProjectContributor;
use App\ProjectMessage;
use Session;
use Auth;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->except(['index']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::where('is_deleted', 0)->get();
        return view('projects.index', compact('projects'));
    }

    public function myProjects(){
        
        $projects = Project::where('user_id', auth()->user()->id)->orderBy('id', 'desc')->where('is_deleted', 0)->get();
        // dd($projects);
        return view('projects.my_projects', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // if(auth()->user()->isPro != 1){
        //     return "You are not authorize";
        // }
        $categories = Category::where('type', 'service')->get();
        return view('projects.create', compact('categories'));
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
            "url" => 'required|unique:projects',
            "end_date" => 'required',
            "image" => 'required'
        ]);
        if($request->hasFile('image')){

            $file = $request->file('image');
            $filename = time() . "-" . $file->getClientOriginalName();
            $path = public_path().'/uploads/projectImages/';
            $file->move($path, $filename);
        }
        $project = new Project;
        $project->user_id = auth()->user()->id;
        $project->category_id = $request->category_id;
        $project->description = $request->description;
        $project->end_date = $request->end_date;
        $project->title = $request->title;
        $project->image = $filename;
        $project->url = $request->url;

        $project->save();
        Session::flash('message', 'Your project is posted successfully. <script>swal.fire("Posted","Your project is posted successfully", "success");</script>'); 
        return redirect(route('ProjectMy'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show($url)
    {
        $project = Project::where('url', $url)->first();
        $appliers = ProjectContributor::where('project_id', $project->id)->where('status', 1)->where('isActive', 1)->where('is_deleted', 0)->get();
        $ifApplied = ProjectContributor::where('project_id', $project->id)->where('user_id', auth()->user()->id)->get();
        
        return view('projects.show', compact('project', 'ifApplied', 'appliers'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy($project_id)
    {
        $post = Project::findOrFail($project_id);
        if(auth()->user()->id != $post->user_id){
            Session::flash('message', 'This project does not belongs to you. <script>swal.fire("error","Not Deleted","This project does not belongs to you");</script>'); 
            return redirect()->back();
        } else {
            $post->is_deleted = 1;
            $post->update();

            Session::flash('message', 'Your project is deleted successfully. <script>swal.fire("success","Posted","Your project is deleted successfully");</script>'); 
            return redirect()->back();
        }
    }

    public function markAsClosed(Request $request){
        $id = $request->project_id;
        $project = Project::findOrFail($id);
        $project->status = 2; // status closed
        $project->update();
        // return redirect()->back();
        $success = 1;
        $message = "Project marked as closed";
        $array = array( 
                'msg' => $message,
                'success' => $success
            );
        return response($array);
    }
    public function markAsOpened(Request $request){
        $id = $request->project_id;
        $project = Project::findOrFail($id);
        $project->status = 1; // status closed
        $project->update();
        // return redirect()->back();
        $success = 1;
        $message = "Project marked as closed";
        $array = array( 
                'msg' => $message,
                'success' => $success
            );
        return response($array);
    }

    public function apply(Request $request){

        $validated = $request->validate([   
            "project_id" => 'required',
        ]);

        $userid = auth()->user()->id;
        $project_id = $request->project_id;
        

        $insert = ProjectContributor::create([
            'project_id' => request('project_id'),
            'user_id' => auth()->user()->id,
        ]);

        Session::flash('message', 'You have applied successfully. <script>swal.fire("Applied","You have applied successfully", "success");</script>'); 
        return redirect()->back();
       
    }
}
