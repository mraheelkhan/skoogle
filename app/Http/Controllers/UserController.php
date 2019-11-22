<?php
use App\User;
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use DB;
use Session;
use DataTables;
use Illuminate\Support\Facades\Hash;
use \App\Department;
use \App\Certificate;
use \App\Designation;
use \App\Staffdetail;

use \App\Preference;

use Carbon;
use DateTime;
use DatePeriod;
use DateInterval;
use Spatie\Activitylog\Models\Activity;
use \App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$users=\App\User::all();
        //$users=\App\User::with('role')->get();
        $users=\App\User::where('iscustomer',0)->get();
        return view('admins',compact('users'));
        //return view('admins');
    }

    public function fetch(){

        $data = \App\User::where('iscustomer',0)->orderBy('id','ASC')->get();
        
        return DataTables::of($data)
        ->addColumn('name',function($data){
            return $data->fname.' '.$data->lname;
        })
        ->addColumn('designation',function($data){
            return $data->designation->name;
        })
        ->addColumn('department',function($data){
            return $data->department->deptname;
        })
        ->addColumn('role',function($data){
            return $data->role->role_title;
        })
        ->addColumn('status',function($data){
          if($data->status==1) {
            return '<span class="label label-success">Active</span>';
          }else{
            return '<span class="label label-danger">Not Active</span>';
          }
         
        })
        ->addColumn('isPro',function($data){
          if($data->isPro==1) {
            return '<span class="label label-success">Pro</span>';
          }else{
            return '<span class="label label-danger">Pro Applied</span>';
          }
         
        })
        ->addColumn('options',function($data){
            $action = '<span class="action_btn">';
            if(Auth::user()->can('show-staff')){
                $action .= '<a href="'.url("/admins/".$data->id).'" class="btn btn-primary" title="View Detail"><i class="fa fa-eye"></i> </a>'; 
            }
            if(Auth::user()->can('edit-staff')){
                $action .= '<a href="'.url("/admins/".$data->id."/edit").'" class="btn btn-success" title="Edit"><i class="fa fa-edit"></i> </a>'; 
            }
            if(Auth::user()->can('status-staff')){
                if ($data->status === 1){
                  $action.= '<a href="'.url("/admins/deactivate/".$data->id).'"  class="btn btn-warning" title="Deactivate"><i class="fa fa-times"></i> </a>';
                }else{
                  $action.= '<a href="'.url("/admins/active/".$data->id).'"  class="btn btn-info" title="Active"><i class="fa fa-check"></i> </a>';
                }
            }
            if(Auth::user()->can('delete-staff')){
                $action.='<button class="btn btn-danger" onclick="archiveFunction("form'.$data->id.')"><i class="fa fa-trash"></i></button>';
            }
            if(Auth::user()->can('staff-reset-password')){
                $action.='<a href="'.url("/admins/resetpassword/".$data->id).'"  class="btn btn-info" title="Reset Password"><i class="fa fa-key"></i> </a>';
            }
            if(Auth::user()->can('edit-staff')){
                $action.='<a href=""  class="btn btn-info" title="Documents"><i class="fa fa-file"></i> </a>';
            }
            $action .= '</span>';
            return $action; 
                                
        })
        ->rawColumns(['options','name','designation','department','status', 'isPro'])
        ->make(true);
    }

    public function indexdatatable()
    {
        $users=\App\User::with('role')->where('iscustomer',0)->get();
        return datatables()->of($users)->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles=\App\Role::all();
        $departments = Department::where('status', 1)->orderBy('deptname', 'ASC')->get();
        $designations = Designation::where('status', 1)->orderBy('name', 'ASC')->get();
        return view('adminscreate',compact('roles','departments','designations'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         
        $this->validate(request(), [
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',         
            'phonenumber' => 'required|numeric|unique:users',
            'department_id' => 'required',
            'designation_id' => 'required',
            'cnic' => 'unique:staffdetails',
            'dob' => '',
            'avatar-1' => ['mimes:jpeg,png']
        ],[
            'fname.required' => 'This Field is requried.',
            'lname.required' => 'This Field is requried.',
            'email.unique' => 'This email address belongs to someone else.',
            'department_id.required' => 'Deparment is required.',
            'designation_id.required' => 'Designation is required.',                            
            'phonenumber.unique' => 'This Mobile number belongs to someone else.',
            'cnic.unique' => 'This CNIC belongs to someone else.',
            'dob.required' => 'Date of birth is required.',
        ]);

        if($request->hasfile('avatar-1'))
         {
            $file = $request->file('avatar-1');
            $avatarname=time().$file->getClientOriginalName();
            $file->move(public_path().'/img/staff', $avatarname);
         }else{
            $avatarname="default_avatar_male.jpg";
         }
         
        try{
            DB::beginTransaction();
            $user= new \App\User;
            $user->fname=$request->get('fname');
            $user->lname=$request->get('lname');
            $user->email=$request->get('email');
            
            $user->role_id=$request->get('role_id');
            $user->organization_id=$request->get('department_id');
            $user->designation_id=$request->get('designation_id');
            $user->password=Hash::make($request->get('password'));
            $user->phonenumber=$request->get('phonenumber');
           
            $date=date_create($request->get('date'));
            $format = date_format($date,"Y-m-d");
            $user->created_at = strtotime($format);
            $user->updated_at = strtotime($format);
            $user->createdby = auth()->user()->id;
            $user->updatedby = auth()->user()->id;
            $user->avatar = $avatarname;
            $user->save();
        
            $userid=$user->id;
            $staffdetail= new \App\Staffdetail;
            $staffdetail->user_id=$userid;
            $dobdate=date_create($request->get('dob'));
            $dobdateformated = date_format($dobdate,"Y-m-d");
            $staffdetail->dob=$dobdateformated;
            $staffdetail->cnic=$request->get('cnic');
            $staffdetail->skypeid=$request->get('skypeid');
            $staffdetail->gender=$request->get('gender');
            $staffdetail->created_at = strtotime($format);
            $staffdetail->updated_at = strtotime($format);
            $staffdetail->save();
         
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
            
            return redirect('admins/create')->with('failed', 'Unable to create staff, Please try again later.\n'.$e->getMessage());
        }


        return redirect('admins/create')->with('success', 'Staff has been created successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $user=\App\User::with('role')->with('organization')->where('id',$id)->first();
        $certificates = Certificate::where('user_id', $id)->get();
    
        return view('adminsshow',compact('user', 'certificates'));
    }

    public function profile(Request $request)
    {
        $user=auth()->user();
        $id=$user->id;      
        //$loginlogs=\App\User::find($id)->authentications;
        if($request->get('srchmonth')){
            $srchmonth=$request->get('srchmonth');
            $searchedMonth=$srchmonth."-01";
            $firstday=date('Y-m-01', strtotime($searchedMonth));
            $lastday=date('Y-m-t', strtotime($searchedMonth));
        }else{
            $firstday=date('Y-m-01');
            $lastday=date('Y-m-t');
            $srchmonth=date('Y-m');
        }
        $attlog=\App\Attendancesheet::where('user_id',$id)->whereBetween('dated', [$firstday , $lastday])->orderBy('dated', 'ASC')->get();
        $adjustments=\App\Adjustment::where('user_id',$id)->where('status','Approved')->whereBetween('dated', [$firstday , $lastday])->orderBy('dated', 'ASC')->get();
        //Get preferences begins
        $preferences= \App\Preference::whereIn('option',['tardydaydeduct','shortleavedaydeduct', 'daysinmonth','absentfine'])->get();
            
        foreach($preferences as $preference){
            if($preference->option=='tardydaydeduct'){
                $settings['tardydaydeduct']=$preference->value;
            }
            if($preference->option=='shortleavedaydeduct'){
                $settings['shortleavedaydeduct']=$preference->value;
            }
            if($preference->option=='daysinmonth'){
                $settings['daysinmonth']=$preference->value;
            }
            if($preference->option=='absentfine'){
                $settings['absentfine']=$preference->value;
            }
        }
        //Get preferences ends
        

        //Get salaries from CCMS begins
        $salaries['ref_comm']=0;
        $salaries['demo_comm']=0;
        $salaries['rec_comm']=0;
        if(!empty($user->staffdetails->ccmsid)){
            $ch = curl_init();
            $url="https://www.yourcloudcampus.com/ccms_business_api/comm_teacher_agent_management_prr_ver2_emp_only_api.php";
            $fromDate=$firstday;
            $toDate=$lastday;
            $ccmsid=$user->staffdetails->ccmsid;
            $qrystring="?fromDate=$fromDate&toDate=$toDate&empID=$ccmsid";
            curl_setopt($ch, CURLOPT_URL,$url.$qrystring);     
            // Receive server response ...
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $ccmsdata = curl_exec($ch);
            curl_close ($ch);
            // Further processing ...
            $salariesdata=json_decode($ccmsdata);
            if(!empty($salariesdata->comm)){
                foreach($salariesdata->comm as $empcomm){
                    if(!empty($empcomm->id) or $empcomm->id!=null){
                        $salaries['ref_comm']=$empcomm->ref_comm;
                        $salaries['demo_comm']=$empcomm->demo_comm;
                        $salaries['rec_comm']=$empcomm->salary;
                    }
                }
            }
        }
        //Get salaries from CCMS ends
        return view('profile',compact('user','attlog', 'srchmonth','adjustments','salaries','settings'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user=\App\User::find($id);
        $roles=\App\Role::all();
        $departments = Department::where('status', 1)->orderBy('deptname', 'ASC')->get();
        $designations = Designation::where('status', 1)->orderBy('name', 'ASC')->get();
        return view('adminsedit',compact('user','roles','id','departments','designations','hrleads'));
    }

    //For Reset Password
    public function resetPassword($id)
    {
        $user=\App\User::find($id);
        return view('resetpassword',compact('user','id'));
    }
    //For Deactivate
    public function deactivate($id)
    {
        $user=\App\User::find($id);         
        $user->status=2;
        $date=now();
        $format = date_format($date,"Y-m-d");
        $user->updated_at = strtotime($format);
        $user->save();
        return redirect()->action(
            'UserController@index'
        )->with('success', 'Staff status has been deactivated.');
    }
    //For Active
    public function active($id)
    {
        $user=\App\User::find($id);         
        $user->status=1;
        $date=now();
        $format = date_format($date,"Y-m-d");
        $user->updated_at = strtotime($format);
        $user->save();
        return redirect()->action(
            'UserController@index'
        )->with('success', 'Staff status has been active.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        

        if($request->get('changepassword')){
        //Change Password
        
            $user=\App\User::find($id); 
            //Check The Current Password Matched
            if (!Hash::check($request->get('oldpassword'), $user->password)){
                return redirect()->back()->with('error', "Current Password not matched.");
            }
            
            $validator = Validator::make($request->all(), [
                'password' => 'required|confirmed|min:6'
            ]);
    
            if ($validator->fails()) {
                return redirect('/changepassword/')
                            ->withErrors($validator)
                            ->withInput();
            }
            
            $user->password=Hash::make($request->get('password'));
            $date=date_create($request->get('date'));
            $format = date_format($date,"Y-m-d");
            $user->updated_at = strtotime($format);
            $user->save();
            return redirect()->back()->with('success', "Your Password has been changed.");


        } elseif($request->get('resetpassword')){
            //$this->authorize('edit-staff');
            //Reset Password
            $user=\App\User::find($id); 
            $validator = Validator::make($request->all(), [
                'password' => 'required|confirmed|min:6'
            ]);
    
            if ($validator->fails()) {
                return redirect('/resetpassword/'.$id)
                            ->withErrors($validator)
                            ->withInput();
            }
            
            $user->password=Hash::make($request->get('password'));
            $date=date_create($request->get('date'));
            $format = date_format($date,"Y-m-d");
            $user->updated_at = strtotime($format);
            $user->save();
            
            /*return redirect()->action(
                'UserController@resetPassword', ['id' => $user->id]
            )->with('success', 'Password has been reset.');*/
            return redirect()->back()->with('success', "Password has been reset.");
        }else{
        //Update Staff/User details
            $this->authorize('edit-staff');
            if($request->hasfile('avatar-1'))
            {
                $file = $request->file('avatar-1');
                $avatarname=time().$file->getClientOriginalName();
                $file->move(public_path().'/img/staff', $avatarname);
            }

            $user=\App\User::find($id); 
            $this->validate(request(), [
                'fname' => 'required',
                'lname' => 'required',
                'email' => 'required|email|unique:users,email,'.$user->id,
                'department_id' => 'required',
                'designation_id' => 'required',
                'cnic' => 'unique:staffdetails,cnic,'.$user->id.',user_id',
                'passportno' => 'nullable|unique:staffdetails,passportno,'.$user->id.',user_id',
                'dob' => 'required',
            ],[
                'fname.required' => 'This Field is requried.',
                'lname.required' => 'This Field is requried.',
                'email.unique' => 'This email address belongs to someone else.',
                'department_id.required' => 'Deparment is required.',
                'designation_id.required' => 'Designation is required.',                            
                'phonenumber.unique' => 'This Mobile number belongs to someone else.',
                'cnic.unique' => 'This CNIC belongs to someone else.',
                'passportno.unique' => 'This Passport No belongs to someone else.',
                'dob.required' => 'Date of birth is required.',
            ]);
            
            
            $user->fname=$request->get('fname');
            $user->lname=$request->get('lname');
            $user->email=$request->get('email');
            
            $user->role_id=$request->get('role_id');
            $user->organization_id=$request->get('department_id');
            $user->designation_id=$request->get('designation_id');
            $user->password=Hash::make($request->get('password'));
            $user->phonenumber=$request->get('phonenumber');
            $date=date_create($request->get('date'));
            $format = date_format($date,"Y-m-d");
            $user->updated_at = strtotime($format);
            $user->updatedby = auth()->user()->id;
            
            if(!$request->get('profile')){
                $user->status=$request->get('status');
            }
            if(isset($avatarname)){
                $user->avatar = $avatarname;
            }
            $user->save();
            //Activity Log begins
            /*$activity = Activity::all()->last();
            $activity->description; 
            $activity->subject; 
            $activity->changes; */
            //Activity Log ends
            $userid=$user->id;
            //$staffdetail= new \App\Staffdetail;
            $staffdetail=\App\Staffdetail::firstOrCreate(['user_id' => $user->id]);
            $staffdetail->user_id=$userid;
            
            $dobdate=date_create($request->get('dob'));
            $dobdateformated = date_format($dobdate,"Y-m-d");
            $staffdetail->dob=$dobdateformated;
            $staffdetail->cnic=$request->get('cnic');
            $staffdetail->passportno=(!empty($request->get('passportno'))) ? $request->get('passportno') : NULL;
            
            $staffdetail->skypeid=$request->get('skypeid');
            $staffdetail->gender=$request->get('gender');
            $staffdetail->updated_at = strtotime($format);
            $staffdetail->save();

            
            if($request->get('profile')){
                $message='Profile details has been updated.';
            }else{
                $message='Staff details has been updated';
            }
            return redirect()->back()->with('success', $message);

            
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $staffdetail = \App\Staffdetail::where('user_id' ,$id)->first();
            $staffdetail->delete();
            

            $user = \App\User::find($id);
            $user->delete();

           

            return redirect()->action(
                'UserController@index' 
            )->with('success', 'Staff has been deleted.');
        } catch(\Illuminate\Database\QueryException $ex){ 
            return redirect()->action(
                'UserController@index' 
            )->with('failed', 'Unable to delete, this USER has linked record(s) in system.');
            //$ex->getMessage()
        }
    }


    public function register(){
        return view('home.register');
    }

    public function registerStore(Request $request){

        $validated = $request->validate([   
            "fname" => 'required|max:50',
            "lname" => 'required|max:50',
            "password" => 'required|max:50',
            "email" => 'required|unique:users|email',
            "phone" => 'required|numeric',
            "image" => 'required',
        ]);

        if($request->hasFile('image')){

            $file = $request->file('image');
            $filename = time() . "-" . $file->getClientOriginalName();
            $path = public_path().'/uploads/profiles/';
            $file->move($path, $filename);
        }

        $user = new User;
        $user->email = $request->email;
        $user->password = Hash::make($request->get('password'));
       
        $user->avatar = $filename;
        $user->fname = $request->fname;
        $user->lname = $request->lname;
        $user->phonenumber = $request->phone;
        $user->organization_id = 0;
        $user->designation_id = 0;
        $user->role_id = 2; //this is user
        $user->save();

        $profile = new StaffDetail;
        $profile->user_id = $user->id;
        // $profile->phone = $request->phone;
        $profile->gender = $request->gender;
        $profile->save();

        Session::flash('message', 'Verification message sent to your email. <script>swal.fire("Verification","Verification message sent to your email.", "success");</script>'); 
        if ($user && $profile){
            return redirect(url('/login'));
        }
        //return "Failed";

    }







}
