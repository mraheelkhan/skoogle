<?php

namespace App\Http\Controllers;

use App\Category;
use DataTables;
use Auth;
use Validator;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        // dd($categories);
        return view('categories.index')->with('categories', $categories);
    }

    public function fetch(){

        $data = Category::orderBy('id','desc')->get();
        return DataTables::of($data)
        ->addColumn('created_at',function($data){
            return $data->created_at->format('Y-m-d');
        })
        ->addColumn('category_name',function($data){
            return ucwords($data->category_name);
        })
        ->addColumn('parent_category_id',function($data){
            if( $data->parent_category_id == 0){
                return "No Parent";
            }
            $category = Category::findOrFail($data->parent_category_id);
            return ucwords($category->category_name);
        })
        ->addColumn('type1',function($data){
            return ucwords($data->type);
        })  
        ->addColumn('status',function($data){
          if($data->status== 0) {
            return '<span class="label label-danger">Disable</span>';
          }else if($data->status== 1){
            return '<span class="label label-success">Active</span>';
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
     
        ->rawColumns(['created_at','category_name', 'parent_category_id', 'type1', 'status','options'])
        ->make(true);
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
        $rules = array(
            'category_name' => 'required',
            'status' => 'required',
            'type' => 'required',
        );

        $data = [
            'category_name' => trim($request->get('category_name')),
            'status' => $request->get('status'),
            'parent_category_id' => $request->get('parent_category_id'),
            'type' => trim($request->get('type')),
            ];
        $validator = Validator::make($data,$rules);
     
        if($validator->fails())
        {
          return  response()->json(['errors'=>$validator->errors()]);
        } 
        else {
            $user_id = Auth::user()->id;
            if(isset($request->edit_id) && ($request->edit_id !="") )
            {
                $data = Category::findOrFail($request->edit_id);
                $data->category_name = $request->category_name;
                $data->status     = $request->status;
                $data->type     = $request->type;
                $data->parent_category_id     = $request->parent_category_id;
                $data->save(); 
                $success = 'Category has been updated.';
                return response()->json($success);
                }else{

                $data = New Category;
                $data->category_name = $request->category_name;
                $data->status     = $request->status;
                $data->type     = $request->type;
                $data->parent_category_id     = $request->parent_category_id;
                $data->user_id     = $user_id;
                $data->save();
                $success = 'Category has been created.';
                return response()->json($success);
            }
        }
      
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $category = Category::findOrFail($request->id);
        return response()->json($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }

    public function categoryActive(Request $request)
    {
      $data = Category::findOrFail($request->id);
      $data->status = 1;
      $data->save();
      $message = 'Successfully Active.';
      return response()->json($message);

    }
     

    public function categoryDisable(Request $request)
    {
      $data = Category::findOrFail($request->id);
      $data->status = 0;
      $data->save();
      $message = 'Successfully Disable.';
      return response()->json($message);

    }
}
