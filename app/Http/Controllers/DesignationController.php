<?php

namespace App\Http\Controllers;

use App\Designation;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use DB;
use Auth;
use Validator;
use App\User;

class DesignationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('designation.index');
    }

    public function fetch(Request $request)
    {
        $columns = array( 
                            0 =>'id', 
                            1 =>'name',
                            2=> 'user_id',
                            3=> 'created_at',
                            4=> 'last_modified_by',
                            5=> 'updated_at',
                            6=> 'id',
                            
                        );

         $totalData = Designation::count();   
         $totalFiltered = $totalData; 

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
            
        if(empty($request->input('search.value')))
        {            
            
                $data = Designation::offset($start)->limit($limit)
                         ->orderBy($order, $dir)
                         ->get();
        }else{
            $search = $request->input('search.value'); 

            $data = Designation::where('id', 'LIKE', '%' . $search . '%')
                              ->orwhere('name', 'LIKE', '%' . $search . '%')
                              ->orwhere('status', 'LIKE', '%' . $search . '%')
                              ->offset($start)
                              ->limit($limit)
                              ->orderBy($order, $dir)
                              ->get();


            $totalFiltered = Designation::where('id', 'LIKE', '%' . $search . '%')
                              ->orwhere('name', 'LIKE', '%' . $search . '%')
                              ->orwhere('status', 'LIKE', '%' . $search . '%')
                              ->count();                  
           
        }


        $dataArray = array();
        if(!empty($data))
        {
            foreach ($data as $row)
            {
                $id = $row->id;               
                $nestedData['id']  = $row->id;
                $nestedData['user_id'] = $row->createdby->fname .' '.$row->createdby->lname;
                $nestedData['name'] = $row->name;
                $nestedData['last_modified_by'] = $row->modifiedby->fname .' '.$row->modifiedby->lname;
                $nestedData['updated_at'] = $row->updated_at->format('d-M-Y');
                $nestedData['created_at'] = $row->created_at->format('d-M-Y');
                $statusaction="";
                $edit="";
                $delete="";
                $token=csrf_token();
                if($row->status=='1') {
                  $nestedData['status'] = '<span class="btn btn-success btn-sm">Active</span>';
                  if(Auth::user()->can('status-designation')){
                    $statusaction="<a class='btn btn-danger status' href='#' data-id='{$id}' data-action='0'><i class='fa fa-times'></i></a>";
                  }
                }else if($row->status=='0'){
                  $nestedData['status'] = '<span class="btn btn-danger btn-sm">Deactive</span>';
                  if(Auth::user()->can('status-designation')){
                    $statusaction="<a class='btn btn-warning status' href='#' data-id='{$id}' data-action='1'><i class='fa fa-check'></i></a>";
                  }
                }
                if(Auth::user()->can('edit-designation')){
                    $edit="<a class='btn btn-primary edit' href='javascript:void(0)' data-id='{$id}'><i class='fa fa-edit'></i></a> ";
                }
                if(Auth::user()->can('delete-designation')){
                    $delete=" <a class='btn btn-danger delete' href='javascript:void(0)' data-id='{$id}'><i class='fa fa-trash'></i></a>
                    <form id=\"form$id\" action=\"{{action('DesignationController@destroy', $id)}}\" method=\"post\" role='form'>
                      <input name=\"_token\" type=\"hidden\" value=\"$token\">
                      <input name=\"id\" type=\"hidden\" value=\"$id\">
                      <input name=\"_method\" type=\"hidden\" value=\"DELETE\">
                      </form>";
                }
                $nestedData['options'] = $edit.$statusaction.$delete;                             
                
                $dataArray[] = $nestedData;

            }
        }
          
        $json_data = array(
                    "draw"            => intval($request->input('draw')),  
                    "recordsTotal"    => intval($totalData),  
                    "recordsFiltered" => intval($totalFiltered), 
                    "data"            => $dataArray   
                    );
          return response()->json($json_data);   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        exit;
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
        
        $this->authorize('create-designation');
        $rules=[
            'name' => 'required|unique:designations',
        ];
        $errormessage=['required'=>"Designation name is required.", 'unique'=>"Designation must be unquie."];
        $validator = Validator::make($request->all(), $rules,$errormessage);
        if ($validator->fails()) {
            //pass validator errors as errors object for ajax response
            return response()->json(['errors'=>$validator->errors()]);
        }

        $designation= new \App\Designation;
        $designation->name=$request->get('name');
        $designation->status=$request->get('status');      
        $designation->user_id=auth()->user()->id;
        $designation->last_modified_by=auth()->user()->id;
        $date=date_create($request->get('date'));
        $format = date_format($date,"Y-m-d H:i:s");
        $designation->created_at = strtotime($format);
        $designation->updated_at = strtotime($format);
		$designation->save();

        return response()->json(['success'=>'Designation created successfully.']);
        
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Designation  $designation
     * @return \Illuminate\Http\Response
     */
    public function show(Designation $designation)
    {
        exit; 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Designation  $designation
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $this->authorize('edit-designation');
        $data = Designation::findOrFail($request->id);
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Designation  $designation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->authorize('edit-designation');
        $designation = \App\Designation::findOrFail($request->get('id'));
        $rules=[
            'name' => 'required|unique:designations,name,'.$designation->id,
        ];
        $errormessage=['required'=>"Designation name is required.", 'unique'=>"Designation must be unquie."];
        $validator = Validator::make($request->all(), $rules,$errormessage);
        if ($validator->fails()) {
            //pass validator errors as errors object for ajax response
            
            return response()->json(['errors'=>$validator->errors()]);
        }
        $designation->name=$request->get('name');
        $designation->status=$request->get('status');      
        $designation->last_modified_by=auth()->user()->id;
        $date=date_create($request->get('date'));
        $format = date_format($date,"Y-m-d H:i:s");
        $designation->updated_at = strtotime($format);
		$designation->save();
        return response()->json(['success'=>'Designation updated successfully.']);
    }
    //For Deactivate
    public function deactivate(Request $request)
    {
        $this->authorize('status-designation');
        $id=$request->get('id');
        $designation=\App\Designation::findOrFail($id);         
        $designation->status=0;
        $designation->last_modified_by=auth()->user()->id;
        $date=date_create($request->get('date'));
        $format = date_format($date,"Y-m-d H:i:s");
        $designation->updated_at = strtotime($format);
		$designation->save();
        return response()->json(['success'=>'Designation updated successfully.']);
    }
    //For Active
    public function active(Request $request)
    {
        $this->authorize('status-designation');
        $id=$request->get('id');
        $designation=\App\Designation::findOrFail($id);         
        $designation->status=1;
        $designation->last_modified_by=auth()->user()->id;
        $date=date_create($request->get('date'));
        $format = date_format($date,"Y-m-d H:i:s");
        $designation->updated_at = strtotime($format);
		$designation->save();
        return response()->json(['success'=>'Designation updated successfully.']);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Designation  $designation
     * @return \Illuminate\Http\Response
     */
    

    public function destroy(Request $request, $id)
    {
        $this->authorize('delete-designation');
        try{
            $id=$id;
            $designation = \App\Designation::findOrFail($id);
            $designation->delete();
            return response()->json(['success'=>'Designation deleted successfully.']);
        } catch(\Illuminate\Database\QueryException $ex){ 
            return response()->json(['success'=>'Unable to delete, this designation has linked record(s) in system.']);
        }
    }
}
