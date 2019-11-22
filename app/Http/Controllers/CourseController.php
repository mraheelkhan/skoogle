<?php

namespace App\Http\Controllers;

use App\Course;
use App\Category;
use App\User;
use App\CourseVideo;
use App\EnrolledCourse;
use App\CourseApplied;
use Illuminate\Http\Request;
use Session;
use Auth;
use Gate;

class CourseController extends Controller
{
    protected $user = User::class;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        if(auth()->user()->isPro != 1){
            Session::flash('message', 'You are not a Pro. <script>swal.fire("error","Not Pro","You are not a pro.");</script>'); 
            return redirect()->back();
        }
        $categories = Category::where('type', 'course')->get();
        return view('courses.create', compact('categories'));
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
            "title" => 'required|max:200',
            "description" => 'required|max:500',
        ]);

        $course = new Course;
        $course->user_id = auth()->user()->id;
        $course->category_id = $request->category_id;
        $course->title = $request->title;
        $course->description = $request->description;
        $course->save();
        Session::flash('message', 'Your course is created successfully. <script>swal.fire("success","Created","Your course is posted successfully");</script>'); 

        return redirect()->route('CourseMy');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show($name, $id)
    {

        if(!auth()->check()){
            return redirect()->route('login');
        }
        $course_id = $id;
        $courses = Course::findOrFail($id);
        $course = Course::findOrFail($id);
        $showcoursevideos = CourseVideo::where('course_id', $id)->where('is_deleted', 0)->get();

        //checking if user is enrolled in the course
        $auth = EnrolledCourse::where('user_id', auth()->user()->id)->where('course_id', $id)->first();
        $appliers = CourseApplied::where('course_id', $courses->id)->where('status', 1)->where('isActive', 1)->where('is_deleted', 0)->get();
        
        if(! empty($auth) || $courses->user_id == auth()->user()->id){
            return view('courses.show', compact('showcoursevideos', 'appliers', 'course'))->with('course_id', $course_id);
        } else {
            Session::flash('message', 'You are not enrolled. <script>swal.fire("error","Not Enrolled","You are not enrolled.");</script>'); 
            return redirect()->back();
        }
        
        
        
    }

    // show category courses
    public function show_category_courses($id)
    {   
        $showcourses = Course::where('category_id', $id)->where('is_deleted', 0)->where('status', 1)->get();
        return view('courses.courses_category', compact('showcourses'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        if(auth()->user()->id != $course->user_id){
            Session::flash('message', 'This course does not belongs to you. <script>swal.fire("error","Not Deleted","This course does not belongs to you");</script>'); 
            return redirect()->back();
        } else {
            $course->is_deleted = 1;
            $course->update();

            Session::flash('message', 'Your course is deleted successfully. <script>swal.fire("success","Deleted","Your course is deleted successfully");</script>'); 
            return redirect()->back();
        }
    }

    public function myCourses(){
        if(!auth()->check()){
            return redirect()->route('login');
        }
        $id = auth()->user()->id;
        $showcourses = Course::where('user_id', $id)->where('is_deleted', 0)->get();
        return view('courses.my_courses', compact('showcourses'));
    }

    public function courseEnroll($course_id){
        $course = Course::findOrFail($course_id);
        $users = User::where('status', 1)->get();
        $enrolledUsers = EnrolledCourse::where('course_id', $course_id)->get();
        $showcourses = Course::where('user_id', auth()->user()->id)->where('is_deleted', 0)->get();
        return view('courses.enroll_course', compact('users','showcourses', 'course', 'enrolledUsers'));
    }
    public function courseEnrollStore($user_id, $course_id){

        $already = EnrolledCourse::where('user_id', $user_id)->where('course_id', $course_id)->first();
        if(!empty($already)){
            Session::flash('message', '*User already enrolled in this course. <script>swal.fire("error","Not Enrolled","User already enrolled in this course.");</script>'); 
            return redirect()->back();
        }
        $course = Course::findOrFail($course_id);
        if(auth()->user()->id != $course->user_id){
            Session::flash('message', 'You cannot enroll a student in someone else course. <script>swal.fire("error","Not Enrolled","You cannot enroll a student in someone else course.");</script>'); 
            return redirect()->back();
        }
        $enroll = new EnrolledCourse;
        $enroll->user_id = $user_id;
        $enroll->course_id = $course_id;
        $enroll->save();

        Session::flash('message', 'You enrolled a student successfully. <script>swal.fire("success","Enrolled","You enrolled a student successfully");</script>'); 

        return redirect()->back();
    }

    public function courseEnrollDelete($id){
        
        $enroll = EnrolledCourse::findOrFail($id);
        $enroll->delete();

        Session::flash('message', 'You have deleted successfully. <script>swal.fire("success","Deleted","You have deleted successfully");</script>'); 
        return redirect()->back();
    }

    public function apply(Request $request){

        $validated = $request->validate([   
            "course_id" => 'required',
        ]);

        $userid = auth()->user()->id;
        $course_id = $request->course_id;
        

        $insert = CourseApplied::create([
            'course_id' => request('course_id'),
            'user_id' => auth()->user()->id,
        ]);

        Session::flash('message', 'You have applied successfully. <script>swal.fire("Applied","You have applied successfully", "success");</script>'); 
        return redirect()->back();
       
    }
    public function cancel($id){
        $applied = CourseApplied::where('course_id', $id)->where('user_id', auth()->user()->id)->first();
        
        if($applied)
        {
            $applied->delete();
            Session::flash('message', 'You have cancel apply successfully. <script>swal.fire("Cancel","You have cancel apply  successfully", "success");</script>'); 
            return redirect()->back();
        }
        Session::flash('message', 'You have not applied yet. <script>swal.fire("Not Applied","You have  not applied yet", "error");</script>'); 
       
        return redirect()->back();
    }

    public function markAsClosed(Request $request){
        $id = $request->course_id;
        $course = Course::findOrFail($id);
        $course->status = 2; // status closed
        $course->update();
        // return redirect()->back();
        $success = 1;
        $message = "Course marked as closed";
        $array = array( 
                'msg' => $message,
                'success' => $success
            );
        return response($array);
    }
    public function markAsOpened(Request $request){
        $id = $request->course_id;
        $course = Course::findOrFail($id);
        $course->status = 1; // status closed
        $course->update();
        // return redirect()->back();
        $success = 1;
        $message = "Course marked as closed";
        $array = array( 
                'msg' => $message,
                'success' => $success
            );
        return response($array);
    }
}
