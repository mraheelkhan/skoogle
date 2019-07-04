<?php

namespace App\Http\Controllers;

use App\ForumQuestion;
use App\ForumAnswer;
use App\Category;
use Illuminate\Http\Request;
use Session;
use DataTables;
class ForumQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = ForumQuestion::where('is_deleted', 0)->where('isActive', 1)->orderBy('created_at', 'desc')->get();
        foreach ($questions as $question) {
            if($question->status == 0){
               $question->status = "Pending";
            }
            else if($question->status == 1){
               $question->status = "Posted";
            }
            else if($question->status == 3){
               $question->status = "Moderate";
            }
            else if($question->status == 4){
               $question->status = "Soloved";
            }
        }
        return view('forum.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('status', 1)->where('is_deleted', 0)->get();
        return view('forum.askquestion')->with('categories', $categories);
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
            "question_title" => 'required|min:20|max:100',
            "category_id" => 'required',
            "question_body" => 'required|min:30|max:3000'
        ]);
        $insert = ForumQuestion::create([
            'question_title' => request('question_title'),
            'category_id' => request('category_id'),
            'question_body' => request('question_body'),
            'user_id' => auth()->user()->id,
        ]);

        Session::flash('message', 'Your question is posted successfully. <script>swal.firePP("success","Posted","Your question is posted successfully");</script>'); 
        return redirect(route('ForumAll'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ForumQuestion  $forumQuestion
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $question = ForumQuestion::findOrFail($id);
        if($question->status == 0){
            $question->status = "Pending";
        }
        else if($question->status == 1){
        $question->status = "Posted";
        }
        else if($question->status == 3){
        $question->status = "Moderate";
        }
        else if($question->status == 4){
        $question->status = "Soloved";
        }
        $answers = ForumAnswer::where('question_id', $id)->where('isActive', 1)->where('is_deleted', 0)->get();
        if($answers){
            $solved = 0;
        } else {
            $solved = 0;
        }

        // to check the marked as solved answer
        foreach($answers as $ans){
            if( $ans->isSolution == 1 ){
                $solved = 1;
                break;
            } else{
                $solved = 0;
            }
        }
        // dd($solved);
        return view('forum.singlequestion')->with('question', $question)->with('answers', $answers)->with('solved', $solved);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ForumQuestion  $forumQuestion
     * @return \Illuminate\Http\Response
     */
    public function edit(ForumQuestion $forumQuestion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ForumQuestion  $forumQuestion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ForumQuestion $forumQuestion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ForumQuestion  $forumQuestion
     * @return \Illuminate\Http\Response
     */
    public function destroy(ForumQuestion $forumQuestion)
    {
        //
    }

    // ============================================================
    // =================== ADMIN FUNCTIONS ========================
    // ============================================================

    public function admin_all(){
        $categories = Category::all();
        return view('forum.indexAdmin', compact('categories'));
    }
    public function adminfetch(){
        $data = ForumQuestion::orderBy('id','desc')->get();
        return DataTables::of($data)
        ->addColumn('created_at',function($data){
            return $data->created_at->format('Y-m-d');
        })
        ->addColumn('question_title',function($data){
            return '<a href="'.route('forum.adminshow', $data->id) . '"> ' . $data->question_title . '</a>';
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
            return '<span class="label label-success">Moderate </span>';
          }
            else if($data->status== 3){
            return '<span class="label label-success">Marked as Solved </span>';
          }
          else{
            return '<span class="label  label-primary">'.$data->status.'</span>';
          }
        })

        ->addColumn('options',function($data){
            if($data->status== 1){
            return "&emsp;<a class='btn btn-success edit_model'
                                     href='#' data-id='".$data->id."'><i class='fa fa-edit'></i></a>
                                     <a data-toggle='tooltip' data-placement='bottom' title='Disable' class='btn btn-danger disable' data-original-title='Disable' href='#' data-id='".$data->id."'><i class='fa fa-close'></i></a>
                                     ";
            }else if($data->status== 0){
             return "&emsp;<a class='btn btn-success edit_model'
                                     href='#' data-id='".$data->id."'><i class='fa fa-edit'></i></a>
                                     <a data-toggle='tooltip' data-placement='bottom' title='Active' class='btn btn-success active' data-original-title='Active' href='#' data-id='".$data->id."'><i class='fa fa-check'></i></a>
                                     "; 
            }                         
        })
     
        ->rawColumns(['created_at','question_title', 'category_name', 'user_id', 'status','options'])
        ->make(true);
    }


    public function adminedit(Request $request){
        $question = ForumQuestion::findOrFail($request->id);
        return response()->json($question);
    }

    public function adminshow($id){
        $question = ForumQuestion::findOrFail($id);
        $answers = ForumAnswer::where('question_id', $question->id)->where('isActive', 1)->where('is_deleted', 0)->get();
        return view('forum.adminshow', compact('question', 'answers'));
    }
}
