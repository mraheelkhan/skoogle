<?php

namespace App\Http\Controllers;

use App\PostComment;
use Illuminate\Http\Request;
use App\Post;
use App\Report;
use Session;
class PostCommentController extends Controller
{
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
            "post_id" => 'required|numeric',
            "comment_body" => 'required|min:10|max:250',
        ]);
        $comment = new PostComment;
        $comment->user_id = auth()->user()->id;
        $comment->post_id = $request->post_id;
        $comment->comment_body = $request->comment_body;
        $comment->save();
        Session::flash('message', 'Your comment is posted successfully. <script>swal.fire("success","Posted","Your comment is posted successfully");</script>'); 
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PostComment  $postComment
     * @return \Illuminate\Http\Response
     */
    public function show(PostComment $postComment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PostComment  $postComment
     * @return \Illuminate\Http\Response
     */
    public function edit(PostComment $postComment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PostComment  $postComment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PostComment $postComment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PostComment  $postComment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $comment = PostComment::findOrFail($id);
        $post = Post::findOrFail($comment->post_id);
        if(auth()->user()->id == $post->user_id){
            $comment->is_deleted = 1;
            $comment->update();

            Session::flash('message', 'Your comment is deleted successfully. <script>swal.fire("success","Posted","Your comment is deleted successfully");</script>'); 
            return redirect()->back();
        }
        if(auth()->user()->id != $comment->user_id){
            Session::flash('message', 'This comment does not belongs to you. <script>swal.fire("error","Not Deleted","This comment does not belongs to you");</script>'); 
            return redirect()->back();
        } else {
            $comment->is_deleted = 1;
            $comment->update();

            Session::flash('message', 'Your comment is deleted successfully. <script>swal.fire("success","Posted","Your comment is deleted successfully");</script>'); 
            return redirect()->back();
        } 
    }

    public function report(Request $request){

        $comment_id = $request->comment_id;
        $reason = $request->report_reason;
        $commenter = PostComment::findOrFail($comment_id);
        $report = new Report;
        $report->user_id = auth()->user()->id;
        $report->reported_user_id = $commenter->id;
        $report->reporter_id = $comment_id;
        $report->report_type = $reason;

        $report->save();
        
        return redirect()->back();


    }
}
