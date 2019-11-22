<?php

namespace App\Http\Controllers;

use App\ForumAnswer;
use Illuminate\Http\Request;
use Auth;
use Session;
class ForumAnswerController extends Controller
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
        //
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
            "answer_body" => 'required|min:20|max:1000',
            "question_id" => 'required',
        ]);
        $insert = ForumAnswer::create([
            'question_id' => request('question_id'),
            'answer_body' => request('answer_body'),
            'user_id' => auth()->user()->id,
        ]);

        Session::flash('message', 'Your answer is posted successfully. <script>swal.firePP("success","Posted","Your answer is posted successfully");</script>'); 
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ForumAnswer  $forumAnswer
     * @return \Illuminate\Http\Response
     */
    public function show(ForumAnswer $forumAnswer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ForumAnswer  $forumAnswer
     * @return \Illuminate\Http\Response
     */
    public function edit(ForumAnswer $forumAnswer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ForumAnswer  $forumAnswer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ForumAnswer $forumAnswer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ForumAnswer  $forumAnswer
     * @return \Illuminate\Http\Response
     */
    public function destroy(ForumAnswer $forumAnswer)
    {
        //
    }

    public function markAsSolution(Request $request){
        $id = $request->answer_id;
        $question_id = $request->question_id;
        $answer = ForumAnswer::findOrFail($id);
        $answerQ = ForumAnswer::where('question_id', $question_id)->get();

        
        foreach($answerQ as $ans){
            if($ans->isSolution == 1){
                $success = 0;
                $message = "Cannot mark multiple answer as solution";
                $array = array( 
                    'msg' => $message,
                    'success' => $success
                );
                return response($array); 
            }
        }

        $answer->isSolution = 1;
        $answer->update();
        $success = 1;
        $message = "Answer marked as solution";
        
        $array = array( 
                'msg' => $message,
                'success' => $success
            );
        return response($array);
    }
}
