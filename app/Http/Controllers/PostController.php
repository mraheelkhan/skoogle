<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;
use Illuminate\Http\Request;
use Session;
use App\PostComment;
use App\Report;
use DataTables;
use Auth;
use Storage;
class PostController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->except('show');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::where('isActive', 1)->orderBy('id', 'desc')->where('is_deleted', 0)->get();
        return view('posts.myposts', compact('posts'));
        
    }

    public function myArticles(){
        
        $posts = Post::where('user_id', auth()->user()->id)->orderBy('id', 'desc')->where('is_deleted', 0)->get();
        return view('posts.myposts', compact('posts'));
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
        $categories = Category::all();
        return view('posts.create', compact('categories'));
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
            "category_id" => 'required',
            "post_content" => 'required|min:100',
            "title" => 'required|max:200',
            "post_url" => 'required|unique:posts',
            "is_comment" => 'required|numeric',
            "image" => 'required',
        ]);
        if($request->hasFile('image')){

            $file = $request->file('image');
            $filename = time() . "-" . $file->getClientOriginalName();
            $path = public_path().'/uploads/postImages/';
            $file->move($path, $filename);
        }
        $post = new Post;
        $post->user_id = auth()->user()->id;
        $post->category_id = $request->category_id;
        $post->post_content = $request->post_content;
        $post->post_title = $request->title;
        $post->post_url = $request->post_url;
        $post->image = $filename;
        $post->is_comment = $request->is_comment;

        $post->save();
        Session::flash('message', 'Your article is posted successfully. <script>swal.fire("success","Posted","Your article is posted successfully");</script>'); 
        return redirect(route('PostMy'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($url)
    {
        $post = Post::where('post_url', $url)->first();
        $comments = PostComment::where('post_id', $post->id)->where('is_deleted', 0)->orderBy('id', 'desc')->get();
        //$reports = [];
        foreach($comments as $comment){
            $reports = Report::where('reporter_id', 2)->get();

        }
        // dd($reports);
        return view('posts.show', compact('post', 'comments', 'reports'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Post::findOrFail($id);
        $categories = Category::all();
        return view('posts.edit', compact('data', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validated = $request->validate([   
            "category_id" => 'required',
            "post_content" => 'required|min:100',
            "title" => 'required|max:200',
            //"post_url" => 'required|unique:posts',
            "is_comment" => 'required|numeric',
            'post_id' => 'required|numeric'
        ]);
        $post = Post::findOrFail($request->post_id);
        $post->user_id = auth()->user()->id;
        $post->category_id = $request->category_id;
        $post->post_content = $request->post_content;
        $post->post_title = $request->title;
        $post->post_url = $request->post_url;
        $post->is_comment = $request->is_comment;

        $post->update();
        Session::flash('message', 'Your article is updated successfully. <script>swal.fire("success","Updated","Your article is updated successfully");</script>'); 
        return redirect(route('PostMy'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $post = Post::findOrFail($id);
        if(auth()->user()->id != $post->user_id){
            Session::flash('message', 'This article does not belongs to you. <script>swal.fire("error","Not Deleted","This article does not belongs to you");</script>'); 
            return redirect()->back();
        } else {
            $post->is_deleted = 1;
            $post->update();

            Session::flash('message', 'Your article is deleted successfully. <script>swal.fire("success","Deleted","Your article is deleted successfully");</script>'); 
            return redirect()->back();
        }
    }

    // Admin Functions 
    public function admin_all(){
        $categories = Category::all();
        return view('posts.indexAdmin', compact('categories'));
    }

    public function adminfetch(){
        $data = Post::orderBy('id','desc')->get();
        return DataTables::of($data)
        ->addColumn('created_at',function($data){
            return $data->created_at->format('Y-m-d');
        })
        ->addColumn('post_title',function($data){
            //return $data->post_title;
            return '<a href="'.route('post.adminshow', $data->id) . '"> ' . $data->post_title . '</a>';
        })
        ->addColumn('category_name',function($data){
            return ucwords($data->category->category_name);
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
     
        ->rawColumns(['created_at','post_title', 'category_name', 'user_id', 'status','options'])
        ->make(true);
    }

    public function adminshow($id){
        $post = Post::findOrFail($id);
        $postcomments = PostComment::where('post_id', $post->id)->where('isActive', 1)->get();
        return view('posts.adminshow', compact('post', 'postcomments'));
    }


    public function adminActive(Request $request)
    {
      $data = Post::findOrFail($request->id);
      $data->isActive = 1;
      $data->update();
      $message = 'Successfully Active.';
      return response()->json($message);
    }
     
    public function adminDisable(Request $request)
    {
      $data = Post::findOrFail($request->id);
      $data->isActive = 0;
      $data->update();
      $message = 'Successfully Disable.';
      return response()->json($message);
    }

    public function adminDelete(Request $request)
    {
      $data = Post::findOrFail($request->comment_id);
      $data->is_deleted = 1;
      $data->update();
      $message = 'Successfully Deleted.';
      return response()->json($message);
    }
    public function adminCommentDelete(Request $request)
    {
      $data = PostComment::findOrFail($request->comment_id);
      $data->is_deleted = 1;
      $data->update();
      $success = 1;
        $message = "comment marked as deleted";
        $array = array( 
                'msg' => $message,
                'success' => $success
            );
        return response($array);
    }
}
