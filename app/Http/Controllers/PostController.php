<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;
use Illuminate\Http\Request;
use Session;
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
        
        return redirect()->route('Home');
    }

    public function myArticles(){
        
        $posts = Post::where('user_id', auth()->user()->id)->orderBy('id', 'desc')->get();
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
        ]);
        $post = new Post;
        $post->user_id = auth()->user()->id;
        $post->category_id = $request->category_id;
        $post->post_content = $request->post_content;
        $post->post_title = $request->title;
        $post->post_url = $request->post_url;
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
      
        return view('posts.show', compact('post'));
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
        Session::flash('message', 'Your article is updated successfully. <script>swal.fire("success","Posted","Your article is updated successfully");</script>'); 
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
            $post->delete();

            Session::flash('message', 'Your article is deleted successfully. <script>swal.fire("success","Posted","Your article is deleted successfully");</script>'); 
            return redirect()->back();
        }
    }
}
