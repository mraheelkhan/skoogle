<?php

namespace App\Http\Controllers;

use App\CourseVideo;
use App\Course;
use App\Category;
use App\EnrolledCourse;
use Illuminate\Http\Request;
use Session;
use Auth;
class CourseVideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $course_id = $id;
        if(auth()->user()->isPro != 1){
            return "You are not authorize";
        }
        $categories = Category::where('type', 'course')->get();
        return view('courses.createVideo', compact('categories', 'course_id'));
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
            "file" => 'required',
            "course_id" => 'required|numeric',
            "title" => 'required|max:200',
            "description" => 'required|max:500',
        ]);

        if($request->hasFile('file')){

            $file = $request->file('file');
            $filename = time() . "-" . $file->getClientOriginalName();
            $path = public_path().'/uploads/videos/';
            $file->move($path, $filename);
        }
        
        $video = new CourseVideo;
        $video->user_id = auth()->user()->id;
        $video->course_id = $request->course_id;
        $video->file_name = $filename;
        $video->title = $request->title;
        $video->description = $request->description;

        $video->save();
        Session::flash('message', 'Your video is posted successfully. <script>swal.fire("success","Posted","Your video is posted successfully");</script>'); 
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CourseVideo  $courseVideo
     * @return \Illuminate\Http\Response
     */
    public function show($name, $id)
    {
        $video = CourseVideo::findOrFail($id);
        if(!auth()->check()){
            return redirect()->route('login');
        }
        $auth = EnrolledCourse::where('user_id', auth()->user()->id)->where('course_id', $video->course_id)->first();
        if(! empty($auth) || $video->course->user_id == auth()->user()->id){
            return view('courses.videoShow', compact('video'));
        } else {
            Session::flash('message', 'You are not enrolled. <script>swal.fire("error","Not Enrolled","You are not enrolled.");</script>'); 
            return redirect()->back();
        }
        
        //dd($video);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CourseVideo  $courseVideo
     * @return \Illuminate\Http\Response
     */
    public function edit(CourseVideo $courseVideo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CourseVideo  $courseVideo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CourseVideo $courseVideo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CourseVideo  $courseVideo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $coursevideo = CourseVideo::findOrFail($id);
        // dd($coursevideo);
        if(auth()->user()->id != $coursevideo->user_id){
            Session::flash('message', 'This course video does not belongs to you. <script>swal.fire("error","Not Deleted","This course video does not belongs to you");</script>'); 
            return redirect()->back();
        } else {
            $coursevideo->is_deleted = 1;
            $coursevideo->update();

            Session::flash('message', 'Your course video is deleted successfully. <script>swal.fire("success","Posted","Your course video is deleted successfully");</script>'); 
            return redirect()->back();
        }
    }
}
