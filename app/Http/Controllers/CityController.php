<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\City;
use App\Country;
use Validator;
use Illuminate\Support\Facades\DB;
use DataTables;
use Auth;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cities = City::where('status','Active')->get();
        $countries = Country::where('status','Active')->get();
        return view('admin.cities.index')->with('cities',$cities)->with('countries',$countries);
    }

    public function fetch(){

        $data = City::orderBy('id','desc')->get();
        return DataTables::of($data)
        ->addColumn('created_at',function($data){
            return $data->created_at->format('Y-m-d');
        })
        ->addColumn('country_id',function($data){
            return $data->country->country_name;
        })
        
        ->addColumn('status',function($data){
          if($data->status=='Disable') {
            return '<span class="label label-danger">Disable</span>';
          }else if($data->status=='Active'){
            return '<span class="label label-success">Active</span>';
          }
          else{
            return '<span class="label  label-primary">'.$data->status.'</span>';
          }
        })

        ->addColumn('options',function($data){
            if($data->status=='Active'){
            return "&emsp;<a class='btn btn-success edit_model'
                                     href='#' data-id='".$data->id."'><i class='fa fa-edit'></i></a>
                                     <a data-toggle='tooltip' data-placement='bottom' title='Disable' class='btn btn-danger disable' data-original-title='Disable' href='#' data-id='".$data->id."'><i class='fa fa-close'></i></a>
                                     ";
            }else if($data->status=='Disable'){
             return "&emsp;<a class='btn btn-success edit_model'
                                     href='#' data-id='".$data->id."'><i class='fa fa-edit'></i></a>
                                     <a data-toggle='tooltip' data-placement='bottom' title='Active' class='btn btn-success active' data-original-title='Active' href='#' data-id='".$data->id."'><i class='fa fa-check'></i></a>
                                     "; 
            }                         
        })
     
        ->rawColumns(['created_at','country_id', 'status','options'])
        ->make(true);
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
            'city_name' => 'required',
            'status' => 'required',
            'country_id' => 'required',
        );

        $data = [
            'city_name' => trim($request->get('city_name')),
            'status' => trim($request->get('status')),
            'country_id' => trim($request->get('country_id')),
            ];
        $validator = Validator::make($data,$rules);
     
      if($validator->fails())
        {
          return  response()->json(['errors'=>$validator->errors()]);
        }else
        {
          $user_id = Auth::user()->id;

          
              if(isset($request->edit_id) && ($request->edit_id !="") )
              {
              
              $data = City::findOrFail($request->edit_id);
              $data->city_name = $request->city_name;
              $data->status     = $request->status;
              $data->country_id     = $request->country_id;
              $data->save(); 
              $success = 'City has been updated.';
              return response()->json($success);
              }else{

              $data = New City;
              $data->city_name = $request->city_name;
              $data->user_id     = $user_id;
              $data->country_id     = $request->country_id;
              $data->status        = 'Active';
              $data->save();
              $success = 'City has been created.';
              return response()->json($success);
            }
          }
      
    }

    
    public function edit(Request $request)
    {
      $cities = City::findOrFail($request->id);
      return response()->json($cities);

    }


    public function cityActive(Request $request)
    {
      $data = City::findOrFail($request->id);
      $data->status = 'Active';
      $data->save();
      $message = 'Successfully Active.';
      return response()->json($message);

    }
     

    public function cityDisable(Request $request)
    {
      $data = City::findOrFail($request->id);
      $data->status = 'Disable';
      $data->save();
      $message = 'Successfully Disable.';
      return response()->json($message);

    }

     public function cityGetByCountry(Request $request)
    {
      $cities = City::where('country_id',$request->id)->where('status','Active')->get();
      //print_r($cities->toArray());exit();
      return response()->json($cities);

    }

   
}
