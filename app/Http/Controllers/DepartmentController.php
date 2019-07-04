<?php

namespace App\Http\Controllers;

use App\Department;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use DB;
use Auth;
use Validator;
use App\User;


class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('department.index');
    }

    public function fetch(Request $request)
    {
        $columns = array( 
                            0 =>'id', 
                            1 =>'deptname',
                            2=> 'user_id',
                            3=> 'address',
                            4=> 'phone_number',
                            5=> 'business_email',
                            6=> 'allow_outside',
                            7=> 'last_modified_by',
                            8=> 'id',
                            
                        );

         $totalData = Department::count();   
         $totalFiltered = $totalData; 

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
            
        if(empty($request->input('search.value')))
        {            
            
                $data = Department::offset($start)->limit($limit)
                         ->orderBy($order, $dir)
                         ->get();
        }else{
            $search = $request->input('search.value'); 

            $data = Department::where('id', 'LIKE', '%' . $search . '%')
                              ->orwhere('deptname', 'LIKE', '%' . $search . '%')
                              ->orwhere('status', 'LIKE', '%' . $search . '%')
                              ->offset($start)
                              ->limit($limit)
                              ->orderBy($order, $dir)
                              ->get();


            $totalFiltered = Department::where('id', 'LIKE', '%' . $search . '%')
                              ->orwhere('deptname', 'LIKE', '%' . $search . '%')
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
                $nestedData['last_modified_by'] = $row->createdby->fname .' '.$row->createdby->lname;
                $nestedData['deptname'] = $row->deptname;
                $nestedData['address'] = $row->address;
                $nestedData['phone_number'] = $row->phone_number;
                $nestedData['business_email'] = $row->business_email;
                $nestedData['allow_outside'] = $row->allow_outside;
                
                $statusaction="";
                $editdept="";
                $deletedept="";
                $token=csrf_token();
                if($row->status=='1') {
                  $nestedData['status'] = '<span class="label label-success btn-sm">Active</span>';
                  if(Auth::user()->can('status-department')){
                    $statusaction="<a class='btn btn-danger status' href='#' data-id='{$id}' data-action='0'><i class='fa fa-times'></i></a>";
                  }
                }else if($row->status=='0'){
                  $nestedData['status'] = '<span class="label label-danger btn-sm">Deactive</span>';
                  if(Auth::user()->can('status-department')){
                    $statusaction="<a class='btn btn-warning status' href='#' data-id='{$id}' data-action='1'><i class='fa fa-check'></i></a>";
                  }
                }
                if(Auth::user()->can('edit-department')){
                    $editdept="<a class='btn btn-primary edit' href='javascript:void(0)' data-id='{$id}'><i class='fa fa-edit'></i></a> ";
                }
                if(Auth::user()->can('delete-department')){
                    $deletedept=" <a class='btn btn-danger delete' href='javascript:void(0)' data-id='{$id}'><i class='fa fa-trash'></i></a>
                    <form id=\"form$id\" action=\"{{action('DepartmentController@destroy', $id)}}\" method=\"post\" role='form'>
                      <input name=\"_token\" type=\"hidden\" value=\"$token\">
                      <input name=\"id\" type=\"hidden\" value=\"$id\">
                      <input name=\"_method\" type=\"hidden\" value=\"DELETE\">
                      </form>";
                }
                $nestedData['options'] = $editdept.$statusaction.$deletedept;                             
                
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
        
        $this->authorize('create-department');
        $rules=[
            'deptname' => 'required|unique:departments',
        ];

        
        $errormessage=['required'=>"Department name is required.", 'unique'=>"Department must be unquie."];
        $validator = Validator::make($request->all(), $rules,$errormessage);
        if ($validator->fails()) {
            //pass validator errors as errors object for ajax response
            return response()->json(['errors'=>$validator->errors()]);
        }

        $department= new \App\Department;
        
        $department->deptname=$request->get('deptname');
        $department->address=$request->get('address');
        $department->business_email=$request->get('business_email');
        $department->phone_number=$request->get('phone_number');
        $department->allow_outside=$request->get('allow_outside');
        $department->status=$request->get('status');      
        $department->user_id=auth()->user()->id;
        $department->last_modified_by=auth()->user()->id;
        $date=date_create($request->get('date'));
        $format = date_format($date,"Y-m-d H:i:s");
        $department->created_at = strtotime($format);
        $department->updated_at = strtotime($format);
		$department->save();

        return response()->json(['success'=>'Department created successfully.']);
        
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        exit; 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $this->authorize('edit-department');
        $data = Department::findOrFail($request->id);
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->authorize('edit-department');
        $department = \App\Department::findOrFail($request->get('id'));
        $rules=[
            'deptname' => 'required|unique:departments,deptname,'.$department->id,
        ];
        $errormessage=['required'=>"Department name is required.", 'unique'=>"Department must be unquie."];
        $validator = Validator::make($request->all(), $rules,$errormessage);
        if ($validator->fails()) {
            //pass validator errors as errors object for ajax response
            
            return response()->json(['errors'=>$validator->errors()]);
        }
        $department->deptname=$request->get('deptname');
        $department->address=$request->get('address');
        $department->business_email=$request->get('business_email');
        $department->phone_number=$request->get('phone_number');
        $department->allow_outside=$request->get('allow_outside');
        $department->status=$request->get('status');      
        $department->last_modified_by=auth()->user()->id;
        $date=date_create($request->get('date'));
        $format = date_format($date,"Y-m-d H:i:s");
        $department->updated_at = strtotime($format);
		$department->save();
        return response()->json(['success'=>'Department updated successfully.']);
    }
    //For Deactivate
    public function deactivate(Request $request)
    {
        $this->authorize('status-department');
        $id=$request->get('id');
        $department=\App\Department::findOrFail($id);         
        $department->status=0;
        $department->last_modified_by=auth()->user()->id;
        $date=date_create($request->get('date'));
        $format = date_format($date,"Y-m-d H:i:s");
        $department->updated_at = strtotime($format);
		$department->save();
        return response()->json(['success'=>'Department updated successfully.']);
    }
    //For Active
    public function active(Request $request)
    {
        $this->authorize('status-department');
        $id=$request->get('id');
        $department=\App\Department::findOrFail($id);         
        $department->status=1;
        $department->last_modified_by=auth()->user()->id;
        $date=date_create($request->get('date'));
        $format = date_format($date,"Y-m-d H:i:s");
        $department->updated_at = strtotime($format);
		$department->save();
        return response()->json(['success'=>'Department updated successfully.']);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    

    public function destroy(Request $request, $id)
    {
        $this->authorize('delete-department');
        try{
            $id=$id;
            $department = \App\Department::findOrFail($id);
            $department->delete();
            // $department->isDeleted = 1;
            // $department->save();
            return response()->json(['success'=>'Department deleted successfully.']);
        } catch(\Illuminate\Database\QueryException $ex){ 
            return response()->json(['success'=>'Unable to delete, this department has linked record(s) in system.']);
        }
    }
}
