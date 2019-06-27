<?php
use App\User;
namespace App\Http\Controllers;
use App\EndService;
use App\UserChecklist;
use App\UserDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use DB;
use DataTables;
use Illuminate\Support\Facades\Hash;
use \App\Department;
use \App\Designation;
use \App\Staffdetail;
use \App\Attendance;
use \App\Attendancesheet;
use \App\Hrlead;
use \App\Preference;
use \App\Holiday;
use Carbon;
use DateTime;
use DatePeriod;
use DateInterval;
use Spatie\Activitylog\Models\Activity;
use \App\User;
use \App\UserEndService;


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
        ->rawColumns(['options','name','designation','department','status'])
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
        return view('adminscreate',compact('roles','departments','designations','hrleads'));

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
            'phonenumber' => 'required|numeric|unique:staffdetails',
            'salary' => 'required|numeric',
            'department_id' => 'required',
            'designation_id' => 'required',
            'cnic' => 'required|unique:staffdetails',
            'passportno' => 'nullable|unique:staffdetails',
            'dob' => 'required',
            'cstreetaddress' => 'required',
            'ccity' => 'required',
            'pstreetaddress' => 'required',
            'pcity' => 'required',
            'gaurdianname' => 'required',
            'gaurdianrelation' => 'required',
            'gaurdiancontact' => 'required',
            'shift' => 'required',
            'avatar-1' => ['mimes:jpeg,png']
        ],[
            'fname.required' => 'This Field is requried.',
            'lname.required' => 'This Field is requried.',
            'email.unique' => 'This email address belongs to someone else.',
            'department_id.required' => 'Deparment is required.',
            'designation_id.required' => 'Designation is required.',                            
            'phonenumber.unique' => 'This Mobile number belongs to someone else.',
            'salary.required' => 'This Field is required numeric value.',
            'salary.numeric' => 'This Field is required numeric value.',
            'cnic.unique' => 'This CNIC belongs to someone else.',
            'passportno.unique' => 'This Passport No belongs to someone else.',
            'dob.required' => 'Date of birth is required.',
            'cstreetaddress.required' => 'This Field is requried.',
            'ccity.required' => 'This Field is requried.',
            'pstreetaddress.required' => 'This Field is requried.',
            'pcity.required' => 'This Field is requried.',
            'gaurdianname.required' => 'This Field is requried.',
            'gaurdianrelation.required' => 'This Field is requried.',
            'gaurdiancontact.required' => 'This Field is requried.',
            'shift.required' => 'This Field is requried.'
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
            $user->officialemail=$request->get('officialemail');
            $user->role_id=$request->get('role_id');
            $user->department_id=$request->get('department_id');
            $user->designation_id=$request->get('designation_id');
            $user->password=Hash::make($request->get('password'));
            $user->phonenumber=$request->get('phonenumber');
            $user->isGoOnAppoints=($request->get('isGoOnAppoints')) ? 1: 0;
            $date=date_create($request->get('date'));
            $format = date_format($date,"Y-m-d");
            $user->created_at = strtotime($format);
            $user->updated_at = strtotime($format);
            $user->createdby = auth()->user()->id;
            $user->updatedby = auth()->user()->id;
            $user->avatar = $avatarname;
            $user->save();
            //Activity Log begins
            $activity = Activity::all()->last();
            $activity->description; 
            $activity->subject; 
            //Activity Log ends

            $userid=$user->id;
            $staffdetail= new \App\Staffdetail;
            $staffdetail->user_id=$userid;
            $staffdetail->salary=$request->get('salary');
            $staffdetail->cstreetaddress=$request->get('cstreetaddress');
            $staffdetail->cstreetaddress2=$request->get('cstreetaddress2');
            $staffdetail->ccity=$request->get('ccity');
            $staffdetail->pstreetaddress=$request->get('pstreetaddress');
            $staffdetail->pstreetaddress2=$request->get('pstreetaddress2');
            $staffdetail->pcity=$request->get('pcity');
            $staffdetail->gaurdianname=$request->get('gaurdianname');
            $staffdetail->gaurdianrelation=$request->get('gaurdianrelation');
            $staffdetail->gaurdiancontact=$request->get('gaurdiancontact');
            $staffdetail->landline=$request->get('landline');
            $staffdetail->phonenumber=$request->get('phonenumber');
            $staffdetail->bloodgroup=$request->get('bloodgroup');
            $dobdate=date_create($request->get('dob'));
            $dobdateformated = date_format($dobdate,"Y-m-d");
            $staffdetail->dob=$dobdateformated;
            $staffdetail->cnic=$request->get('cnic');
            $staffdetail->passportno=(!empty($request->get('passportno'))) ? $request->get('passportno') : NULL;
            $staffdetail->attendanceid=$request->get('attendanceid');
            $staffdetail->extension=$request->get('extension');
            $staffdetail->ccmsid=$request->get('ccmsid');
            $staffdetail->hrlead_id=$request->get('hrlead_id');
            $staffdetail->skypeid=$request->get('skypeid');
            $staffdetail->shift=$request->get('shift');
            $staffdetail->fileno=$request->get('fileno');
            $staffdetail->gender=$request->get('gender');
            $staffdetail->showinsalary=($request->get('showinsalary')) ? $request->get('showinsalary') : 0 ;
            if($request->has('latecomming')){
                $staffdetail->latecomming=$request->get('latecomming');
            }
            if($request->has('earlygoing')){
                $staffdetail->earlygoing=$request->get('earlygoing');
            }
            
            if($request->has('attendancecheck')){
                $staffdetail->attendancecheck=$request->get('attendancecheck');
            }else{
                $staffdetail->attendancecheck=1;
            }

            $sdate=date_create($request->get('joiningdate'));
            $joiningdate = date_format($sdate,"Y-m-d");
            $staffdetail->joiningdate=$joiningdate;
            $sdate=date_create($request->get('starttime'));
            $starttime = date_format($sdate,"H:i");
            $edate=date_create($request->get('endtime'));
            $endtime = date_format($edate,"H:i");
            $staffdetail->starttime=$starttime;
            $staffdetail->endtime=$endtime;
            $staffdetail->created_at = strtotime($format);
            $staffdetail->updated_at = strtotime($format);
            $staffdetail->save();
             //Activity Log begins
             $activity = Activity::all()->last();
             $activity->description; 
             $activity->subject; 
             //Activity Log ends
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
       
        $checklists = UserDocument::all();
        $endservicechecklis = EndService::all();
        $userchecklists = UserChecklist::where('user_id',$id)->get();
        $userendservicechecklists = UserEndService::where('user_id',$id)->first();
        $user=\App\User::with('role')->where('id',$id)->first();
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
        return view('adminsshow',compact('user','attlog', 'srchmonth','adjustments','checklists','userchecklists','endservicechecklis','salaries','settings','userendservicechecklists'));



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
        $hrleads = HrLead::where('status', 13)->orderBy('name', 'ASC')->get();
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


        }elseif($request->get('resetpassword')){
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
                'phonenumber' => 'unique:staffdetails,phonenumber,'.$user->id.',user_id',
                'salary' => 'required|numeric',
                'cnic' => 'unique:staffdetails,cnic,'.$user->id.',user_id',
                'passportno' => 'nullable|unique:staffdetails,passportno,'.$user->id.',user_id',
                'dob' => 'required',
                'cstreetaddress' => 'required',
                'ccity' => 'required',
                'pstreetaddress' => 'required',
                'pcity' => 'required',
                'gaurdianname' => 'required',
                'gaurdianrelation' => 'required',
                'gaurdiancontact' => 'required',
                'shift' => 'required'
            ],[
                'fname.required' => 'This Field is requried.',
                'lname.required' => 'This Field is requried.',
                'email.unique' => 'This email address belongs to someone else.',
                'department_id.required' => 'Deparment is required.',
                'designation_id.required' => 'Designation is required.',                            
                'phonenumber.unique' => 'This Mobile number belongs to someone else.',
                'salary.required' => 'This Field is required numeric value.',
                'salary.numeric' => 'This Field is required numeric value.',
                'cnic.unique' => 'This CNIC belongs to someone else.',
                'passportno.unique' => 'This Passport No belongs to someone else.',
                'dob.required' => 'Date of birth is required.',
                'cstreetaddress.required' => 'This Field is requried.',
                'ccity.required' => 'This Field is requried.',
                'pstreetaddress.required' => 'This Field is requried.',
                'pcity.required' => 'This Field is requried.',
                'gaurdianname.required' => 'This Field is requried.',
                'gaurdianrelation.required' => 'This Field is requried.',
                'gaurdiancontact.required' => 'This Field is requried.',
                'shift.required' => 'This Field is requried.'
            ]);
            
            
            $user->fname=$request->get('fname');
            $user->lname=$request->get('lname');
            $user->email=$request->get('email');
            $user->officialemail=$request->get('officialemail');
            $user->role_id=$request->get('role_id');
            $user->department_id=$request->get('department_id');
            $user->designation_id=$request->get('designation_id');
            $user->password=Hash::make($request->get('password'));
            $user->phonenumber=$request->get('phonenumber');
            $user->isGoOnAppoints=($request->get('isGoOnAppoints')) ? 1: 0;
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
            $staffdetail->salary=$request->get('salary');
            $staffdetail->cstreetaddress=$request->get('cstreetaddress');
            $staffdetail->cstreetaddress2=$request->get('cstreetaddress2');
            $staffdetail->ccity=$request->get('ccity');
            $staffdetail->pstreetaddress=$request->get('pstreetaddress');
            $staffdetail->pstreetaddress2=$request->get('pstreetaddress2');
            $staffdetail->pcity=$request->get('pcity');
            $staffdetail->gaurdianname=$request->get('gaurdianname');
            $staffdetail->gaurdianrelation=$request->get('gaurdianrelation');
            $staffdetail->gaurdiancontact=$request->get('gaurdiancontact');
            $staffdetail->landline=$request->get('landline');
            $staffdetail->phonenumber=$request->get('phonenumber');
            $staffdetail->bloodgroup=$request->get('bloodgroup');
            $dobdate=date_create($request->get('dob'));
            $dobdateformated = date_format($dobdate,"Y-m-d");
            $staffdetail->dob=$dobdateformated;
            $staffdetail->cnic=$request->get('cnic');
            $staffdetail->passportno=(!empty($request->get('passportno'))) ? $request->get('passportno') : NULL;
            $staffdetail->attendanceid=$request->get('attendanceid');
            $staffdetail->extension=$request->get('extension');
            $staffdetail->ccmsid=$request->get('ccmsid');
            $staffdetail->hrlead_id=$request->get('hrlead_id');
            $staffdetail->skypeid=$request->get('skypeid');
            $staffdetail->shift=$request->get('shift');
            $staffdetail->fileno=$request->get('fileno');
            $staffdetail->gender=$request->get('gender');
            $staffdetail->showinsalary=($request->get('showinsalary')) ? $request->get('showinsalary') : 0 ;
            
            if($request->has('latecomming')){
                $staffdetail->latecomming=$request->get('latecomming');
            }
            if($request->has('earlygoing')){
                $staffdetail->earlygoing=$request->get('earlygoing');
            }
            
            if($request->has('attendancecheck')){
                $staffdetail->attendancecheck=$request->get('attendancecheck');
            }
            $sdate=date_create($request->get('joiningdate'));
            $joiningdate = date_format($sdate,"Y-m-d");
            $staffdetail->joiningdate=$joiningdate;
            $sdate=date_create($request->get('starttime'));
            $starttime = date_format($sdate,"H:i");
            $edate=date_create($request->get('endtime'));
            $endtime = date_format($edate,"H:i");
            $staffdetail->starttime=$starttime;
            $staffdetail->endtime=$endtime;
            $staffdetail->updated_at = strtotime($format);
            $staffdetail->save();
             //Activity Log begins
             /*$activity = Activity::all()->last();
             $activity->description; 
             $activity->subject; */
             //Activity Log ends

            
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
            //Activity Log begins
            $activity = Activity::all()->last();
            $activity->description; 
            //Activity Log ends

            $user = \App\User::find($id);
            $user->delete();

             //Activity Log begins
             $activity = Activity::all()->last();
             $activity->description; 
             //Activity Log ends

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

    public function readnofication(Request $request)
    {
        $id=$request->get('id');
        $data['id']=$id;
        Auth::user()->unreadNotifications->where('id', $id)->markAsRead();
        die(json_encode($data));
        exit;
    }
    public function getatt(Request $request)
    {
        $attlog=json_decode($request->get('attlog'),true);
        //dd($attlog);
        
        foreach($attlog['Row'] as $att){
           // dd($att);
           
            $userinfo= \App\Staffdetail::where('attendanceid',$att['PIN'])->first();
            //dd($userinfo['user_id']);
            if(!empty($userinfo)){
               // dd($userinfo->toArray());
                $newattlog= new \App\Attendance;
                $newattlog->user_id=$userinfo['user_id'];
                $attdate=date_create($att['DateTime']);
                $attendancedate = date_format($attdate,"Y-m-d H:i:s");
                $attendancetime = date_format($attdate,"H:i:s");
                $newattlog->attendancedate=$attendancedate;
                $newattlog->attendancetime=$attendancetime;
                $newattlog->machineuserid=$att['PIN'];
                $newattlog->state=$att['Status'];
                $newattlog->status=0;
                $date=date_create($request->get('date'));
                $format = date_format($date,"Y-m-d H:i:s");
                $newattlog->created_at = strtotime($format);
                $newattlog->updated_at = strtotime($format);
                $newattlog->save();
            }
        }
        return "OK";

    }
    public function calculateatt(Request $request)
    {
        
            //Check If Attendance table has the data begins
            $attdatacheck=\App\Attendance::all();
            if($attdatacheck->count() <= 0){
                //If no data then no action 
                echo "No data found";
                exit;
            }
            //Check If Attendance table has the data ends
                    
            //Get Preferences begins
            $latecoming=0;
            $earlygoing=0;
            $tardylimit=0;
            $satrudayearlyleaving=0;

            $generallatecoming=0;
            $generalearlygoing=0;
            
            $preferences= \App\Preference::whereIn('option',['latecomming','earlyleaving', 'tardylimit', 'satrudayearlyleaving'])->get();
            
            foreach($preferences as $preference){
                if($preference->option=='latecomming'){
                    $latecoming=$preference->value;
                    $generallatecoming=$preference->value;
                }
                if($preference->option=='earlyleaving'){
                    $earlygoing=$preference->value;
                    $generalearlygoing=$preference->value;
                }
                if($preference->option=='tardylimit'){
                    $tardylimit=$preference->value;
                }
                if($preference->option=='satrudayearlyleaving'){
                    $satrudayearlyleaving=$preference->value;
                }
            }
            /*
            echo "Settings<br>";
            echo "Late Coming=". $latecoming;
            echo "<br>Early Going=". $earlygoing;
            echo "<br>Trady Limit=". $tardylimit;
            echo "<hr>";*/
            //Get Preferences ends
            //Get User from begins
            $users=User::where('iscustomer',0)
                //->where('status',1)
                ->whereHas('staffdetails', function ($query) {
                    $query->where('showinsalary', '=', 1);
                })
                ->get();
            //Get User from Ends
            //Foreach Loop Begins
            foreach($users as $user){
                //Get Att Log begins
                //$userinfo=\App\User::where('id',$user->user_id)->first();
                $userinfo=$user;
                //echo "<hr>";
                echo $userinfo->id.' '.$userinfo->fname.' '.$userinfo->lname."<br>";
                //Get Att log ends
                //Check if user Attendance Check is true begins
                //echo "End time: ";
                //echo $userinfo->staffdetails->endtime;

                //Creating Monthly Date range begins
                
                //$fromdate='2019-02-01';

                $firstday = new DateTime('first day of this month');
                $firstday->format('Y-m-d');
                $currentmonth=date("m", strtotime($firstday->format('Y-m-d')));
                $currentyear=date("Y", strtotime($firstday->format('Y-m-d')));
                //$firstday = new DateTime(date('Y-m-d', strtotime($fromdate)));

                $firstday = new DateTime('first day of this month');
                $firstday->format('Y-m-d');
                $firstday->sub(new DateInterval('P1D'));
                //$lastday = new DateTime('last day of this month');
                $yesterday=date('Y-m-d',strtotime("-1 days")); //Till Yesterday
                $todate=date('Y-m-d'); 
                $lastday = new DateTime(date('Y-m-d', strtotime($todate)));
                $lastday->format('Y-m-d');
                $begin = $firstday;
                $end = $lastday;
                $end = $end->modify( '+1 day' ); 
                
                $interval = new DateInterval('P1D');
                $daterange = new DatePeriod($begin, $interval ,$end);
                
                //Creating Monthly Date range ends
                //echo $userinfo->staffdetails->attendancecheck;exit;
                if($userinfo->staffdetails->attendancecheck==1){
                        //Check User Execption begins
                        if($userinfo->staffdetails->latecomming!=null && $userinfo->staffdetails->latecomming > 0){
                            $latecoming=$userinfo->staffdetails->latecomming;
                        }else{
                            $latecoming=$generallatecoming;
                        }

                        if($userinfo->staffdetails->earlygoing!=null && $userinfo->staffdetails->earlygoing > 0){
                            $earlygoing=$userinfo->staffdetails->earlygoing;
                        }else{
                            $earlygoing=$generalearlygoing;
                        }
                        
                        //Check User Execption ends 
                        
                        $dateArray=array();
                        $i=0;
                        
                        foreach($daterange as $date){
                            //echo $date->format("Y-m-d") . "<br>";
                             $datefrom=$date->format("Y-m-d").' '.$userinfo->staffdetails->starttime;
                             $dt_from = date('Y-m-d H:i:s', strtotime($datefrom . "-2 hour"));                            
                             $dateArray[$i]['from']=$dt_from;
                            
                             $dt_to=$date->format("Y-m-d").' '.$userinfo->staffdetails->endtime;
                             $hr=substr($userinfo->staffdetails->endtime,0,2);
                             if($hr > '16' && $hr < '23'){
                                $dt_to = date('Y-m-d H:i:s', strtotime($dt_to . "+5hour"));
                             }else{
                                $dt_to = date('Y-m-d H:i:s', strtotime($dt_to . "+1 days +5hour"));
                             }
                             //$dt_to = date('Y-m-d H:i:s', strtotime($dt_to . "+1 days +4hour"));
                             $dateArray[$i]['to']=$dt_to;
                             $i++;
                        }
                        /*echo "<pre>";
                        print_r($dateArray);
                        echo "</pre>";*/
                        
                        foreach($dateArray as $row){
                            print_r($row);
                            $attlogdata=\App\Attendance::where('status', 0)->where('user_id',$user->id)->whereBetween('attendancedate', [$row['from'], $row['to']])->orderby('attendancedate','ASC')->get();
                            if(count($attlogdata) > 0){
                                    echo "Data found<br>";
                                        
                                        $firstlog=$attlogdata->first();
                                        $lastlog=$attlogdata->last();
                                        
                                        echo "First= ".$firstlog;
                                        echo "<br>";
                                        echo "Last= ".$lastlog;
                                        echo "<br>";
                                        
                                        if($lastlog->state==1){
                                            $checkoutfound='Yes';
                                        }else{
                                            $checkoutfound='No';
                                        }

                                        $attendancedate = date_format($firstlog->attendancedate,"Y-m-d H:i:s");
                                        $attendancedatelast = date_format($lastlog->attendancedate,"Y-m-d H:i:s");
                                        $checkindate = date_format($firstlog->attendancedate,"Y-m-d");                   
                                        //$dated = date_format($firstlog->attendancedate,"Y-m-d");
                                        //$dated = date('Y-m-d H:i:s', strtotime($row['from']));
                                        $dated = date('Y-m-d', strtotime($row['from']));
                                        $checkindate=$checkindate.' '.$userinfo->staffdetails->starttime;
                                        $checkoutdate = date_format($lastlog->attendancedate,"Y-m-d");                   
                                        $checkoutdate=$checkoutdate.' '.$userinfo->staffdetails->endtime;
                                        
                                        /*echo 'Clock Marked='.$attendancedate;
                                        echo "<br>";
                                        echo 'Setting Clock In='.$checkindate;
                                        echo "<br>";
                                        echo 'Setting Clock Out='.$checkoutdate;
                                        echo "<br>";*/
                                        $checkin = date_format($firstlog->attendancedate,"H:i:s");
                                        $checkout= date_format($lastlog->attendancedate,"H:i:s");
                                        $status="P";
                                        $tardycount=0;
                                        $shortleavecount=0;
                                        $paid=1;
                                        $remarks="Present";
                                        //Get day begins
                                        $day = date('D', strtotime($row['from']));
                                        echo $day . "<br>";
                                        //Get day ends

                                        //CheckIn status based on Time
                                        if(!empty($latecoming) or $latecoming!==null){
                                            $to = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $checkindate);
                                            $from = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $attendancedate);
                                            $diff_in_minutes = $to->diffInMinutes($from,false);       
                                            /*echo "Check in time different: ".$diff_in_minutes;
                                            echo "<br> Late Coming Margin: ".$latecoming;
                                            echo "<br> Tardy Limit Margin: ".$tardylimit;*/

                                            if($diff_in_minutes > 0 && $diff_in_minutes > $latecoming && $diff_in_minutes < $tardylimit){
                                                $status="P";
                                                $tardycount++;
                                                $remarks="Late Arrival";
                                                $paid=2;
                                            }elseif($diff_in_minutes > 0 &&  $diff_in_minutes > $latecoming && $diff_in_minutes > $tardylimit){
                                                $status="P";
                                                $shortleavecount=1;
                                                $remarks="Short Leave";
                                                $paid=2;
                                            }
                                        }
                                        echo "<br> Remarks: ".$remarks."<br>";
                                        //echo $status."<br>";
                                        //Check if its checkout time begins
                                        if(!empty($earlygoing) or $earlygoing!==null){
                                            //echo "Check Out condition<br>";
                                            $to = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $attendancedatelast);
                                            $from = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $checkoutdate);
                                            $checkout_check_min = $to->diffInMinutes($from,false);
                                            echo "<br> Check out time different: ".$checkout_check_min;
                                            echo "<br> Early going margin: ".$earlygoing;
                                            echo "<br> Tardy limit margin: ".$tardylimit;
                                            echo "<br>";
                                            if($checkout_check_min > 0 && $checkout_check_min > $earlygoing && $checkout_check_min < $tardylimit ){
                                                //Saturday Check begins
                                                if($day=='Sat' && $checkout_check_min <= $satrudayearlyleaving ){
                                                    $status="P";
                                                    $remarks="Saturday Exception";
                                                }else{
                                                    $status="P";
                                                    if($remarks=="Late Arrival"){
                                                        $remarks="Late Arrival and Early Left";
                                                    }else{
                                                        $remarks="Early Left";
                                                    }
                                                    $paid=2;
                                                    $tardycount++;
                                                }
                                                //Saturday Check ends

                                            }elseif($checkout_check_min > 0  && $checkout_check_min > $earlygoing && $checkout_check_min > $tardylimit){
                                                //Saturday Check begins
                                                if($day=='Sat' && $checkout_check_min <= $satrudayearlyleaving ){
                                                    $status="P";
                                                    $remarks="Saturday Exception";
                                                }else{
                                                    $status="P";
                                                    $remarks="Short Leave";
                                                    $paid=2;
                                                    $shortleavecount=1;
                                                    
                                                }
                                                //Saturday Check ends
                                            }
                                            /*else{
                                                $status="Present";
                                                $remarks="Present";
                                                $paid=1;
                                                $shortleavecount=0;
                                            }*/

                                        }
                                        $workedhours=0;
                                        $to = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $attendancedate);
                                        $from = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $attendancedatelast);
                                        $workedhours = $to->diffInHours($from,false);
                                        //echo $workedhours;
                                        
                                        //Check If today is holiday begins
                                            $holiday=\App\Holiday::where('dated', $dated)->first();
                                            if(isset($holiday) && $holiday->isworking==0){
                                                $status="H";
                                                $tardycount=0;
                                                $shortleavecount=0;
                                                $remarks=$holiday->description;
                                                $paid=1;
                                            }elseif(isset($holiday) && $holiday->isworking==1){
                                                $status="P";
                                                $tardycount=0;
                                                $shortleavecount=0;
                                                $remarks=$holiday->description;
                                                $paid=1;
                                            }
                                            unset($holiday);
                                        //Check If today is holiday ends

                                        //Sunday Check begins
                                        if($day=='Sun'){
                                            $status="P";
                                            $tardycount=0;
                                            $shortleavecount=0;
                                            $remarks='Sunday';
                                            $paid=1;
                                        }
                                        //Sunday Check ends

                                      

                                        //echo "<b>".$remarks."</b><br>";
                                        //echo $status."<br>";
                                        //Check if its checkout time ends
                                        //Create object and Insert or Update begins
                                        
                                        //Check if record already exists begins
                                        $updateatt=1;
                                        $newatt = Attendancesheet::where('user_id',$user->id)->where('dated',$dated)->first();
                                        if(empty($newatt)){
                                            $newatt = new Attendancesheet;
                                        }else{                                            
                                            //Check If Att record is 3 days old begins
                                            $db_dated=\Carbon\Carbon::parse($newatt->dated);
                                            $currentdated= new \Carbon\Carbon();    
                                            $diffInDays=$db_dated->diffInDays($currentdated);
                                            //echo "Diff In Days to update: ".$diffInDays."<br>";
                                            if($diffInDays > 3){
                                                $updateatt=0;
                                            }else{
                                                $updateatt=1;
                                            }
                                            //Check If Att record is 3 days old ends
                                            //Check if Att record manually updated begins
                                            if($newatt->isupdated==1){
                                                $updateatt=0;
                                            }
                                            //Check if Att record manually updated ends                    
                                        }
                                        
                                        //Check if record already exists ends
                                        if($updateatt==1){
                                            $newatt->user_id=$userinfo->id;
                                            $newatt->dated=$dated;
                                            $newatt->dayname=$day;
                                            $newatt->remarks=$remarks;
                                            $newatt->paid=$paid;
                                            $newatt->attendancedate=$attendancedate;
                                            $newatt->checkin=$checkin;
                                            $newatt->checkout=$checkout;
                                            $newatt->checkoutfound=$checkoutfound;
                                            $newatt->tardies=$tardycount;
                                            $newatt->shortleaves=$shortleavecount;
                                            $newatt->workedhours=$workedhours;
                                            $newatt->status=$status;
                                            $date=date_create($request->get('date'));
                                            $format = date_format($date,"Y-m-d H:i:s");
                                            $newatt->created_at = strtotime($format);
                                            $newatt->updated_at = strtotime($format);
                                            $newatt->save();
                                        }
                                        //Create object and Insert or Update ends
                                        
                                
                            }else{
                                //print_r($row);
                                $day = date('D', strtotime($row['from']));
                                $dated=date('Y-m-d', strtotime($row['from']));
                                $joiningdate=\Carbon\Carbon::parse($user->staffdetails->joiningdate);
                                $endingdate=\Carbon\Carbon::parse($user->staffdetails->endingdate);
                                $second= \Carbon\Carbon::parse($row['from']);    
                                if($day=='Sun'){
                                        $remarks="Sunday"; 
                                        $status="P";                                    
                                }else{
                                    $holiday=\App\Holiday::where('dated', $dated)->first();
                                    $leave=\App\Leave::where('dated', $dated)->where('user_id',$user->id)->where('status','Approved')->first();
                                    if(isset($holiday)){
                                        if($holiday->isworking==0){
                                            $status="P";
                                            $remarks=$holiday->description;
                                            $paid=1;
                                        }elseif($holiday->isworking==1){
                                            $status="X";
                                            $remarks="Absent";
                                            $paid=0;
                                        }
                                        //Check If today is Sunday or Public Holiday begins
                                        //$remarks=$holiday->description;
                                        //$status="Holiday";
                                        //Check If today is Sunday or Public Holiday ends
                                    }elseif(isset($leave)){
                                        //Check If user is on leave begins
                                        //Check if Paid leave
                                        if($leave->ispaid==1){
                                            $remarks=$leave->leavetype .'-'. $leave->description ;
                                            $status=$leave->leavetype;
                                            $paid=1;
                                        }else{
                                            $remarks=$leave->leavetype .'-'. $leave->description ;
                                            $status='UL';
                                            $paid=0;
                                        }
                                        //Check If user is on leave ends
                                    }else{
                                        //Else user is on Absent begins
                                        $remarks="Absent";
                                        $status="X";
                                        $paid=0;
                                        //Else user is on Absent ends
                                    }                               
                                }
                                //Check if joining is not reached begins
                                if($joiningdate->greaterThan($second)){
                                    $remarks="Not Applicable/Joined";
                                    $status="-";
                                    $paid=0;
                                }
                                //Check if joining is not reached ends
                                //Check if ending date begins
                                if($user->staffdetails->endingdate != null && $endingdate->lessThanOrEqualTo($second)){
                                    $remarks="Not Applicable/Left";
                                    $status="-";
                                    $paid=0;
                                }
                                //Check if ending date ends
                                
                                //Create object and Insert or Update begins
                                
                                //Check if record already exists begins
                                
                                //Check if record already exists begins
                                $updateatt=1;
                                $newatt = Attendancesheet::where('user_id',$user->id)->where('dated',$dated)->first();
                                if(empty($newatt)){
                                    $newatt = new Attendancesheet;
                                }else{
                                    //Check If Att record is 3 days old begins
                                    $db_dated=\Carbon\Carbon::parse($newatt->dated);
                                    $currentdated= new \Carbon\Carbon();    
                                    $diffInDays=$db_dated->diffInDays($currentdated);
                                    //echo "Diff In Days to update: ".$diffInDays."<br>";
                                    if($diffInDays > 3){
                                        $updateatt=0;
                                    }else{
                                        $updateatt=1;
                                    }
                                    //Check If Att record is 3 days old ends
                                    //Check if Att record manually updated begins
                                    if($newatt->isupdated==1){
                                        $updateatt=0;
                                    }
                                    //Check if Att record manually updated ends
                                }                        
                                //Check if record already exists ends
                                if($updateatt==1){
                                    $newatt->user_id=$userinfo->id;
                                    $newatt->dated=$dated;
                                    $newatt->dayname=$day;
                                    $newatt->remarks=$remarks;
                                    $newatt->paid=$paid;
                                    $newatt->attendancedate=$dated;
                                    $newatt->checkin=0;
                                    $newatt->checkout=0;
                                    $newatt->checkoutfound='No';
                                    $newatt->tardies=0;
                                    $newatt->shortleaves=0;
                                    $newatt->workedhours=0;
                                    $newatt->status=$status;
                                    $date=date_create($request->get('date'));
                                    $format = date_format($date,"Y-m-d H:i:s");
                                    $newatt->created_at = strtotime($format);
                                    $newatt->updated_at = strtotime($format);
                                    $newatt->save();
                                }
                                //Create object and Insert or Update ends
                                echo "No data<br>";
                            }
                            
                        }
                    
                        
                   
                }else{
                    //No Attendance check
                    //echo "No Attendance Check";
                    $dateArray=array();
                    $i=0;
                    foreach($daterange as $date){
                        //echo $date->format("Y-m-d") . "<br>";
                            $datefrom=$date->format("Y-m-d").' '.$userinfo->staffdetails->starttime;
                            $dt_from = date('Y-m-d H:i:s', strtotime($datefrom . "-4 hour"));                            
                            $dateArray[$i]['from']=$dt_from;
                        
                            $dt_to=$date->format("Y-m-d").' '.$userinfo->staffdetails->endtime;
                            $hr=substr($userinfo->staffdetails->endtime,0,2);
                            if($hr > '16' && $hr < '23'){
                               $dt_to = date('Y-m-d H:i:s', strtotime($dt_to . "+5hour"));
                            }else{
                                $dt_to = date('Y-m-d H:i:s', strtotime($dt_to . "+1 days +1hour"));
                                //$dt_to = date('Y-m-d H:i:s', strtotime($dt_to . "+1 days"));
                            }
                            //$dt_to = date('Y-m-d H:i:s', strtotime($dt_to . "+1 days +4hour"));
                            $dateArray[$i]['to']=$dt_to;
                            $i++;
                    }
                    /*echo "<pre>";
                    print_r($dateArray);
                    echo "</pre>";*/
                        
                    foreach($dateArray as $row){
                        echo "From: ".$row['from']."  ==> To: ".$row['to']."<br>";
                        $attlogdata=\App\Attendance::where('status', 0)->where('user_id',$user->id)->whereBetween('attendancedate', [$row['from'], $row['to']])->orderby('attendancedate','ASC')->get();
                        if(count($attlogdata) > 0){
                            echo "Data Found<br>";
                            //Data found
                            $firstlog=$attlogdata->first();
                            $lastlog=$attlogdata->last();
                            echo "First= ".$firstlog;
                            echo "<br>";
                            echo "Last= ".$lastlog;
                            echo "<br>";
                            
                            if($lastlog->state==1){
                                $checkoutfound='Yes';
                            }else{
                                $checkoutfound='No';
                            }

                            $attendancedate = date_format($firstlog->attendancedate,"Y-m-d H:i:s");
                            $attendancedatelast = date_format($lastlog->attendancedate,"Y-m-d H:i:s");
                            $checkindate = date_format($firstlog->attendancedate,"Y-m-d");                   
                            //$dated = date_format($firstlog->attendancedate,"Y-m-d");
                            $dated = date("Y-m-d", strtotime($row['from']));
                            $checkindate=$checkindate.' '.$userinfo->staffdetails->starttime;
                            $checkoutdate = date_format($lastlog->attendancedate,"Y-m-d");                   
                            $checkoutdate=$checkoutdate.' '.$userinfo->staffdetails->endtime;
                            
                            echo 'Clock Marked='.$attendancedate;
                            echo "<br>";
                            echo 'Setting Clock In='.$checkindate;
                            echo "<br>";
                            echo 'Setting Clock Out='.$checkoutdate;
                            echo "<br>";
                            $checkin = date_format($firstlog->attendancedate,"H:i:s");
                            $checkout= date_format($lastlog->attendancedate,"H:i:s");
                            $status="P";
                            $tardycount=0;
                            $shortleavecount=0;
                            $paid=1;
                            $remarks="Present";
                            //Get day begins
                            $day = date('D', strtotime($row['from']));
                            $workedhours=0;
                            $to = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $attendancedate);
                            $from = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $attendancedatelast);
                            $workedhours = $to->diffInHours($from,false);
                            //echo $workedhours;
                            
                            //Sunday Check begins
                            if($day=='Sun'){
                                $status="P";
                                $tardycount=0;
                                $shortleavecount=0;
                                $remarks='Sunday';
                                $paid=1;
                            }
                            //Sunday Check ends

                            //Check If today is holiday begins
                            //if($day!='Sun' && $day!='Sat'){
                            if($day!='Sun'){
                                $holiday=\App\Holiday::where('dated', $dated)->first();
                                if(isset($holiday) && $holiday->isworking==0){
                                    $status="H";
                                    $tardycount=0;
                                    $shortleavecount=0;
                                    $remarks=$holiday->description;
                                    $paid=1;
                                }elseif(isset($holiday) && $holiday->isworking==1){
                                    $status="P";
                                    $tardycount=0;
                                    $shortleavecount=0;
                                    $remarks=$holiday->description;
                                    $paid=1;
                                }
                                unset($holiday);
                            }
                            //Check If today is holiday ends
                            


                        }else{
                            //Data not found
                            echo "<br>No Data Found<br>";
                            $day = date('D', strtotime($row['from']));
                            $dated=date('Y-m-d', strtotime($row['from']));
                            $workedhours=0;
                            $checkoutfound="No";
                            $checkin=0;
                            $checkout=0;
                            $status="X";
                            $tardycount=0;
                            $shortleavecount=0;
                            $remarks='Absent';
                            $paid=0;
                            if($day=='Sun'){
                                $status="P";
                                $tardycount=0;
                                $shortleavecount=0;
                                $remarks='Sunday';
                                $paid=1;
                            }
                            //Sunday Check ends

                            //Check If today is holiday begins
                            //if($day!='Sun' && $day!='Sat'){
                            if($day!='Sun'){
                                $holiday=\App\Holiday::where('dated', $dated)->first();
                                $leave=\App\Leave::where('dated', $dated)->where('user_id',$user->id)->where('status','Approved')->first();
                                if(isset($holiday)){
                                    if($holiday->isworking==0){
                                        $status="P";
                                        $remarks=$holiday->description;
                                        $paid=1;
                                    }elseif($holiday->isworking==1){
                                        $status="X";
                                        $remarks="Absent";
                                        $paid=0;
                                    }
                                    //Check If today is Sunday or Public Holiday begins
                                    //$remarks=$holiday->description;
                                    //$status="Holiday";
                                    //Check If today is Sunday or Public Holiday ends
                                }elseif(isset($leave)){
                                    //Check If user is on leave begins
                                    //Check if Paid leave
                                    if($leave->ispaid==1){
                                        $remarks=$leave->leavetype .'-'. $leave->description ;
                                        $status=$leave->leavetype;
                                        $paid=1;
                                    }else{
                                        $remarks=$leave->leavetype .'-'. $leave->description ;
                                        $status='UL';
                                        $paid=0;
                                    }
                                    //Check If user is on leave ends
                                }else{
                                    //Else user is on Absent begins
                                    $remarks="Absent";
                                    $status="X";
                                    $paid=0;
                                    //Else user is on Absent ends
                                } 

                                /*if(isset($holiday) && $holiday->isworking==0){
                                    $status="H";
                                    $tardycount=0;
                                    $shortleavecount=0;
                                    $remarks=$holiday->description;
                                    $paid=1;
                                }elseif(isset($holiday) && $holiday->isworking==1){
                                    $status="P";
                                    $tardycount=0;
                                    $shortleavecount=0;
                                    $remarks=$holiday->description;
                                    $paid=1;
                                }*/
                                unset($holiday);
                            }
                            //Check If today is holiday ends
                        }
                        $joiningdate=\Carbon\Carbon::parse($user->staffdetails->joiningdate);
                        $endingdate=\Carbon\Carbon::parse($user->staffdetails->endingdate);
                        $second= \Carbon\Carbon::parse($dated);    
                        //Check if joining is not reached begins
                        if($joiningdate->greaterThan($second)){
                            $remarks="Not Applicable/Joined";
                            $status="-";
                            $paid=0;
                        }
                        //Check if joining is not reached ends
                        //Check if ending date begins
                        //echo "Ending Date " .$endingdate->lessThanOrEqualTo($second);
                        if($user->staffdetails->endingdate != null && $endingdate->lessThanOrEqualTo($second)){
                            $remarks="Not Applicable/Left";
                            $status="-";
                            $paid=0;
                        }
                        //exit;
                        //Check if ending date ends
                        //Create object and Insert or Update begins

                        //Check if record already exists begins
                        $updateatt=1;
                        $newatt = Attendancesheet::where('user_id',$user->id)->where('dated',$dated)->first();
                        if(empty($newatt)){
                            $newatt = new Attendancesheet;
                        }else{
                            //Check If Att record is 3 days old begins
                            $db_dated=\Carbon\Carbon::parse($newatt->dated);
                            $currentdated= new \Carbon\Carbon();    
                            $diffInDays=$db_dated->diffInDays($currentdated);
                            //echo "Diff In Days to update: ".$diffInDays."<br>";
                            if($diffInDays > 3){
                                $updateatt=0;
                            }else{
                                $updateatt=1;
                            }
                            //Check If Att record is 3 days old ends
                            //Check if Att record manually updated begins
                            if($newatt->isupdated==1){
                                $updateatt=0;
                            }
                            //Check if Att record manually updated ends
                        }                 
                        if($userinfo->id==257 && $dated=='2019-02-12'){
                            echo "Hello";
                            echo $remarks;
                            echo "<br>";                             
                            echo $status;
                            
                        }       
                        //Check if record already exists ends
                        if($updateatt==1){
                            $newatt->user_id=$userinfo->id;
                            $newatt->dated=$dated;
                            $newatt->dayname=$day;
                            $newatt->remarks=$remarks;
                            $newatt->paid=$paid;
                            $newatt->attendancedate=$dated;
                            $newatt->checkin=$checkin;
                            $newatt->checkout=$checkout;
                            $newatt->checkoutfound=$checkoutfound;
                            $newatt->tardies=$tardycount;
                            $newatt->shortleaves=$shortleavecount;
                            $newatt->workedhours=$workedhours;
                            $newatt->status=$status;
                            $date=date_create($request->get('date'));
                            $format = date_format($date,"Y-m-d H:i:s");
                            $newatt->created_at = strtotime($format);
                            $newatt->updated_at = strtotime($format);
                            $newatt->save();
                        }
                        //Create object and Insert or Update ends
                    }

                }
                //Check if user Attendance Check is true ends
        }//End foreach
        //Transfer all attendance data to attendance log table begins
        DB::select("delete from  attendancelogs where Month(attendancedate)=".$currentmonth." and Year(attendancedate)=".$currentyear);
        $moveattlogs=DB::insert("INSERT INTO attendancelogs (user_id,attendancedate,attendancetime,machineuserid,state,status,created_at,updated_at)
        SELECT user_id,attendancedate,attendancetime,machineuserid,state,'1',created_at,updated_at
        FROM attendances");
        if($moveattlogs){
            DB::select("delete from  attendances");
        }
        
        //Transfer all attendance data to attendance log table ends
    }


    



//disable it after fixing begins 
public function calculateattfix(Request $request)
    {
        
            //exit;
            //Check If Attendance table has the data begins
            $attdatacheck=\App\Attendance::all();
            if($attdatacheck->count() <= 0){
                //If no data then no action 
                echo "No data found";
                exit;
            }
            //Check If Attendance table has the data ends
                    
            //Get Preferences begins
            $latecoming=0;
            $earlygoing=0;
            $tardylimit=0;
            $satrudayearlyleaving=0;

            $generallatecoming=0;
            $generalearlygoing=0;
            
            $preferences= \App\Preference::whereIn('option',['latecomming','earlyleaving', 'tardylimit', 'satrudayearlyleaving'])->get();
            
            foreach($preferences as $preference){
                if($preference->option=='latecomming'){
                    $latecoming=$preference->value;
                    $generallatecoming=$preference->value;
                }
                if($preference->option=='earlyleaving'){
                    $earlygoing=$preference->value;
                    $generalearlygoing=$preference->value;
                }
                if($preference->option=='tardylimit'){
                    $tardylimit=$preference->value;
                }
                if($preference->option=='satrudayearlyleaving'){
                    $satrudayearlyleaving=$preference->value;
                }
            }
            /*
            echo "Settings<br>";
            echo "Late Coming=". $latecoming;
            echo "<br>Early Going=". $earlygoing;
            echo "<br>Trady Limit=". $tardylimit;
            echo "<hr>";*/
            //Get Preferences ends
            //Get User from begins
            $users=User::where('iscustomer',0)
                //->where('status',1)
                ->whereHas('staffdetails', function ($query) {
                    $query->where('showinsalary', '=', 1);
                })
                ->get();
            //Get User from Ends
            //Foreach Loop Begins
            foreach($users as $user){
                //Get Att Log begins
                //$userinfo=\App\User::where('id',$user->user_id)->first();
                $userinfo=$user;
                //echo "<hr>";
                echo $userinfo->id.' '.$userinfo->fname.' '.$userinfo->lname."<br>";
                //Get Att log ends
                //Check if user Attendance Check is true begins
                //echo "End time: ";
                //echo $userinfo->staffdetails->endtime;

                //Creating Monthly Date range begins
                
                $fromdate='2019-04-30';

                $firstday = new DateTime('first day of this month');
                $firstday->format('Y-m-d');
                $currentmonth=date("m", strtotime($firstday->format('Y-m-d')));
                $currentyear=date("Y", strtotime($firstday->format('Y-m-d')));
                $firstday = new DateTime(date('Y-m-d', strtotime($fromdate)));

                $firstday->format('Y-m-d');
                $firstday->sub(new DateInterval('P1D'));
                //$lastday = new DateTime('last day of this month');
                $yesterday=date('Y-m-d',strtotime("-1 days")); //Till Yesterday
                $todate='2019-05-02'; 
                $lastday = new DateTime(date('Y-m-d', strtotime($todate)));
                $lastday->format('Y-m-d');
                $begin = $firstday;
                $end = $lastday;
                $end = $end->modify( '+1 day' ); 
                
                $interval = new DateInterval('P1D');
                $daterange = new DatePeriod($begin, $interval ,$end);
                
                //Creating Monthly Date range ends
                //echo $userinfo->staffdetails->attendancecheck;exit;
                if($userinfo->staffdetails->attendancecheck==1){
                        //Check User Execption begins
                        if($userinfo->staffdetails->latecomming!=null && $userinfo->staffdetails->latecomming > 0){
                            $latecoming=$userinfo->staffdetails->latecomming;
                        }else{
                            $latecoming=$generallatecoming;
                        }

                        if($userinfo->staffdetails->earlygoing!=null && $userinfo->staffdetails->earlygoing > 0){
                            $earlygoing=$userinfo->staffdetails->earlygoing;
                        }else{
                            $earlygoing=$generalearlygoing;
                        }
                        
                        //Check User Execption ends 
                        
                        $dateArray=array();
                        $i=0;
                        
                        foreach($daterange as $date){
                            //echo $date->format("Y-m-d") . "<br>";
                             $datefrom=$date->format("Y-m-d").' '.$userinfo->staffdetails->starttime;
                             $dt_from = date('Y-m-d H:i:s', strtotime($datefrom . "-2 hour"));                            
                             $dateArray[$i]['from']=$dt_from;
                            
                             $dt_to=$date->format("Y-m-d").' '.$userinfo->staffdetails->endtime;
                             $hr=substr($userinfo->staffdetails->endtime,0,2);
                             if($hr > '16' && $hr < '23'){
                                $dt_to = date('Y-m-d H:i:s', strtotime($dt_to . "+5hour"));
                             }else{
                                $dt_to = date('Y-m-d H:i:s', strtotime($dt_to . "+1 days +5hour"));
                             }
                             //$dt_to = date('Y-m-d H:i:s', strtotime($dt_to . "+1 days +4hour"));
                             $dateArray[$i]['to']=$dt_to;
                             $i++;
                        }
                        /*echo "<pre>";
                        print_r($dateArray);
                        echo "</pre>";*/
                        
                        foreach($dateArray as $row){
                            print_r($row);
                            $attlogdata=\App\Attendance::where('user_id',$user->id)->whereBetween('attendancedate', [$row['from'], $row['to']])->orderby('attendancedate','ASC')->get();
                            if(count($attlogdata) > 0){
                                    echo "Data found<br>";
                                        
                                        $firstlog=$attlogdata->first();
                                        $lastlog=$attlogdata->last();
                                        
                                        echo "First= ".$firstlog;
                                        echo "<br>";
                                        echo "Last= ".$lastlog;
                                        echo "<br>";
                                        
                                        if($lastlog->state==1){
                                            $checkoutfound='Yes';
                                        }else{
                                            $checkoutfound='No';
                                        }

                                        $attendancedate = date_format($firstlog->attendancedate,"Y-m-d H:i:s");
                                        $attendancedatelast = date_format($lastlog->attendancedate,"Y-m-d H:i:s");
                                        $checkindate = date_format($firstlog->attendancedate,"Y-m-d");                   
                                        //$dated = date_format($firstlog->attendancedate,"Y-m-d");
                                        //$dated = date('Y-m-d H:i:s', strtotime($row['from']));
                                        $dated = date('Y-m-d', strtotime($row['from']));
                                        $checkindate=$checkindate.' '.$userinfo->staffdetails->starttime;
                                        $checkoutdate = date_format($lastlog->attendancedate,"Y-m-d");                   
                                        $checkoutdate=$checkoutdate.' '.$userinfo->staffdetails->endtime;
                                        
                                        /*echo 'Clock Marked='.$attendancedate;
                                        echo "<br>";
                                        echo 'Setting Clock In='.$checkindate;
                                        echo "<br>";
                                        echo 'Setting Clock Out='.$checkoutdate;
                                        echo "<br>";*/
                                        $checkin = date_format($firstlog->attendancedate,"H:i:s");
                                        $checkout= date_format($lastlog->attendancedate,"H:i:s");
                                        $status="P";
                                        $tardycount=0;
                                        $shortleavecount=0;
                                        $paid=1;
                                        $remarks="Present";
                                        //Get day begins
                                        $day = date('D', strtotime($row['from']));
                                        echo $day . "<br>";
                                        //Get day ends

                                        //CheckIn status based on Time
                                        if(!empty($latecoming) or $latecoming!==null){
                                            $to = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $checkindate);
                                            $from = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $attendancedate);
                                            $diff_in_minutes = $to->diffInMinutes($from,false);       
                                            /*echo "Check in time different: ".$diff_in_minutes;
                                            echo "<br> Late Coming Margin: ".$latecoming;
                                            echo "<br> Tardy Limit Margin: ".$tardylimit;*/

                                            if($diff_in_minutes > 0 && $diff_in_minutes > $latecoming && $diff_in_minutes < $tardylimit){
                                                $status="P";
                                                $tardycount++;
                                                $remarks="Late Arrival";
                                                $paid=2;
                                            }elseif($diff_in_minutes > 0 &&  $diff_in_minutes > $latecoming && $diff_in_minutes > $tardylimit){
                                                $status="P";
                                                $shortleavecount=1;
                                                $remarks="Short Leave";
                                                $paid=2;
                                            }
                                        }
                                        echo "<br> Remarks: ".$remarks."<br>";
                                        //echo $status."<br>";
                                        //Check if its checkout time begins
                                        if(!empty($earlygoing) or $earlygoing!==null){
                                            //echo "Check Out condition<br>";
                                            $to = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $attendancedatelast);
                                            $from = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $checkoutdate);
                                            $checkout_check_min = $to->diffInMinutes($from,false);
                                            echo "<br> Check out time different: ".$checkout_check_min;
                                            echo "<br> Early going margin: ".$earlygoing;
                                            echo "<br> Tardy limit margin: ".$tardylimit;
                                            echo "<br>";
                                            if($checkout_check_min > 0 && $checkout_check_min > $earlygoing && $checkout_check_min < $tardylimit ){
                                                //Saturday Check begins
                                                if($day=='Sat' && $checkout_check_min <= $satrudayearlyleaving ){
                                                    $status="P";
                                                    $remarks="Saturday Exception";
                                                }else{
                                                    $status="P";
                                                    if($remarks=="Late Arrival"){
                                                        $remarks="Late Arrival and Early Left";
                                                    }else{
                                                        $remarks="Early Left";
                                                    }
                                                    $paid=2;
                                                    $tardycount++;
                                                }
                                                //Saturday Check ends

                                            }elseif($checkout_check_min > 0  && $checkout_check_min > $earlygoing && $checkout_check_min > $tardylimit){
                                                //Saturday Check begins
                                                if($day=='Sat' && $checkout_check_min <= $satrudayearlyleaving ){
                                                    $status="P";
                                                    $remarks="Saturday Exception";
                                                }else{
                                                    $status="P";
                                                    $remarks="Short Leave";
                                                    $paid=2;
                                                    $shortleavecount=1;
                                                    
                                                }
                                                //Saturday Check ends
                                            }
                                            /*else{
                                                $status="Present";
                                                $remarks="Present";
                                                $paid=1;
                                                $shortleavecount=0;
                                            }*/

                                        }
                                        $workedhours=0;
                                        $to = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $attendancedate);
                                        $from = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $attendancedatelast);
                                        $workedhours = $to->diffInHours($from,false);
                                        //echo $workedhours;
                                        
                                        //Check If today is holiday begins
                                            $holiday=\App\Holiday::where('dated', $dated)->first();
                                            if(isset($holiday) && $holiday->isworking==0){
                                                $status="H";
                                                $tardycount=0;
                                                $shortleavecount=0;
                                                $remarks=$holiday->description;
                                                $paid=1;
                                            }elseif(isset($holiday) && $holiday->isworking==1){
                                                $status="P";
                                                $tardycount=0;
                                                $shortleavecount=0;
                                                $remarks=$holiday->description;
                                                $paid=1;
                                            }
                                            unset($holiday);
                                        //Check If today is holiday ends

                                        //Sunday Check begins
                                        if($day=='Sun'){
                                            $status="P";
                                            $tardycount=0;
                                            $shortleavecount=0;
                                            $remarks='Sunday';
                                            $paid=1;
                                        }
                                        //Sunday Check ends

                                      

                                        //echo "<b>".$remarks."</b><br>";
                                        //echo $status."<br>";
                                        //Check if its checkout time ends
                                        //Create object and Insert or Update begins
                                        
                                        //Check if record already exists begins
                                        $updateatt=1;
                                        $newatt = Attendancesheet::where('user_id',$user->id)->where('dated',$dated)->first();
                                        if(empty($newatt)){
                                            $newatt = new Attendancesheet;
                                        }else{                                            
                                            //Check If Att record is 3 days old begins
                                            $db_dated=\Carbon\Carbon::parse($newatt->dated);
                                            $currentdated= new \Carbon\Carbon();    
                                            $diffInDays=$db_dated->diffInDays($currentdated);
                                            //echo "Diff In Days to update: ".$diffInDays."<br>";
                                            /*if($diffInDays > 7){
                                                $updateatt=0;
                                            }else{
                                                $updateatt=1;
                                            }*/
                                            //Check If Att record is 3 days old ends
                                            //Check if Att record manually updated begins
                                            if($newatt->isupdated==1){
                                                $updateatt=0;
                                            }
                                            //Check if Att record manually updated ends                    
                                        }
                                        
                                        //Check if record already exists ends
                                        if($updateatt==1 && $dated=='2019-04-30'){
                                            $newatt->user_id=$userinfo->id;
                                            $newatt->dated=$dated;
                                            $newatt->dayname=$day;
                                            $newatt->remarks=$remarks;
                                            $newatt->paid=$paid;
                                            $newatt->attendancedate=$attendancedate;
                                            $newatt->checkin=$checkin;
                                            $newatt->checkout=$checkout;
                                            $newatt->checkoutfound=$checkoutfound;
                                            $newatt->tardies=$tardycount;
                                            $newatt->shortleaves=$shortleavecount;
                                            $newatt->workedhours=$workedhours;
                                            $newatt->status=$status;
                                            $date=date_create($request->get('date'));
                                            $format = date_format($date,"Y-m-d H:i:s");
                                            $newatt->created_at = strtotime($format);
                                            $newatt->updated_at = strtotime($format);
                                            $newatt->save();
                                        }
                                        //Create object and Insert or Update ends
                                        
                                
                            }else{
                                //print_r($row);
                                $day = date('D', strtotime($row['from']));
                                $dated=date('Y-m-d', strtotime($row['from']));
                                $joiningdate=\Carbon\Carbon::parse($user->staffdetails->joiningdate);
                                $endingdate=\Carbon\Carbon::parse($user->staffdetails->endingdate);
                                $second= \Carbon\Carbon::parse($row['from']);    
                                if($day=='Sun'){
                                        $remarks="Sunday"; 
                                        $status="P";                                    
                                }else{
                                    $holiday=\App\Holiday::where('dated', $dated)->first();
                                    $leave=\App\Leave::where('dated', $dated)->where('user_id',$user->id)->where('status','Approved')->first();
                                    if(isset($holiday)){
                                        if($holiday->isworking==0){
                                            $status="P";
                                            $remarks=$holiday->description;
                                            $paid=1;
                                        }elseif($holiday->isworking==1){
                                            $status="X";
                                            $remarks="Absent";
                                            $paid=0;
                                        }
                                        //Check If today is Sunday or Public Holiday begins
                                        //$remarks=$holiday->description;
                                        //$status="Holiday";
                                        //Check If today is Sunday or Public Holiday ends
                                    }elseif(isset($leave)){
                                        //Check If user is on leave begins
                                        //Check if Paid leave
                                        if($leave->ispaid==1){
                                            $remarks=$leave->leavetype .'-'. $leave->description ;
                                            $status=$leave->leavetype;
                                            $paid=1;
                                        }else{
                                            $remarks=$leave->leavetype .'-'. $leave->description ;
                                            $status='UL';
                                            $paid=0;
                                        }
                                        //Check If user is on leave ends
                                    }else{
                                        //Else user is on Absent begins
                                        $remarks="Absent";
                                        $status="X";
                                        $paid=0;
                                        //Else user is on Absent ends
                                    }                               
                                }
                                //Check if joining is not reached begins
                                if($joiningdate->greaterThan($second)){
                                    $remarks="Not Applicable/Joined";
                                    $status="-";
                                    $paid=0;
                                }
                                //Check if joining is not reached ends
                                //Check if ending date begins
                                if($user->staffdetails->endingdate != null && $endingdate->lessThanOrEqualTo($second)){
                                    $remarks="Not Applicable/Left";
                                    $status="-";
                                    $paid=0;
                                }
                                //Check if ending date ends
                                
                                //Create object and Insert or Update begins
                                
                                //Check if record already exists begins
                                
                                //Check if record already exists begins
                                $updateatt=1;
                                $newatt = Attendancesheet::where('user_id',$user->id)->where('dated',$dated)->first();
                                if(empty($newatt)){
                                    $newatt = new Attendancesheet;
                                }else{
                                    //Check If Att record is 3 days old begins
                                    $db_dated=\Carbon\Carbon::parse($newatt->dated);
                                    $currentdated= new \Carbon\Carbon();    
                                    $diffInDays=$db_dated->diffInDays($currentdated);
                                    //echo "Diff In Days to update: ".$diffInDays."<br>";
                                    /*if($diffInDays > 7){
                                        $updateatt=0;
                                    }else{
                                        $updateatt=1;
                                    }*/
                                    //Check If Att record is 3 days old ends
                                    //Check if Att record manually updated begins
                                    if($newatt->isupdated==1){
                                        $updateatt=0;
                                    }
                                    //Check if Att record manually updated ends
                                }                        
                                
                                //Check if record already exists ends
                                if($updateatt==1 && $dated=='2019-04-30'){
                                    $newatt->user_id=$userinfo->id;
                                    $newatt->dated=$dated;
                                    $newatt->dayname=$day;
                                    $newatt->remarks=$remarks;
                                    $newatt->paid=$paid;
                                    $newatt->attendancedate=$dated;
                                    $newatt->checkin=0;
                                    $newatt->checkout=0;
                                    $newatt->checkoutfound='No';
                                    $newatt->tardies=0;
                                    $newatt->shortleaves=0;
                                    $newatt->workedhours=0;
                                    $newatt->status=$status;
                                    $date=date_create($request->get('date'));
                                    $format = date_format($date,"Y-m-d H:i:s");
                                    $newatt->created_at = strtotime($format);
                                    $newatt->updated_at = strtotime($format);
                                    $newatt->save();
                                }
                                //Create object and Insert or Update ends
                                echo "No data<br>";
                            }
                            
                        }
                    
                        
                   
                }else{
                    //No Attendance check
                    //echo "No Attendance Check";
                    $dateArray=array();
                    $i=0;
                    foreach($daterange as $date){
                        //echo $date->format("Y-m-d") . "<br>";
                            $datefrom=$date->format("Y-m-d").' '.$userinfo->staffdetails->starttime;
                            $dt_from = date('Y-m-d H:i:s', strtotime($datefrom . "-4 hour"));                            
                            $dateArray[$i]['from']=$dt_from;
                        
                            $dt_to=$date->format("Y-m-d").' '.$userinfo->staffdetails->endtime;
                            $hr=substr($userinfo->staffdetails->endtime,0,2);
                            if($hr > '16' && $hr < '23'){
                               $dt_to = date('Y-m-d H:i:s', strtotime($dt_to . "+5hour"));
                            }else{
                                $dt_to = date('Y-m-d H:i:s', strtotime($dt_to . "+1 days +1hour"));
                                //$dt_to = date('Y-m-d H:i:s', strtotime($dt_to . "+1 days"));
                            }
                            //$dt_to = date('Y-m-d H:i:s', strtotime($dt_to . "+1 days +4hour"));
                            $dateArray[$i]['to']=$dt_to;
                            $i++;
                    }
                    /*echo "<pre>";
                    print_r($dateArray);
                    echo "</pre>";*/
                        
                    foreach($dateArray as $row){
                        echo "From: ".$row['from']."  ==> To: ".$row['to']."<br>";
                        $attlogdata=\App\Attendance::where('user_id',$user->id)->whereBetween('attendancedate', [$row['from'], $row['to']])->orderby('attendancedate','ASC')->get();
                        if(count($attlogdata) > 0){
                            echo "Data Found<br>";
                            //Data found
                            $firstlog=$attlogdata->first();
                            $lastlog=$attlogdata->last();
                            echo "First= ".$firstlog;
                            echo "<br>";
                            echo "Last= ".$lastlog;
                            echo "<br>";
                            
                            if($lastlog->state==1){
                                $checkoutfound='Yes';
                            }else{
                                $checkoutfound='No';
                            }

                            $attendancedate = date_format($firstlog->attendancedate,"Y-m-d H:i:s");
                            $attendancedatelast = date_format($lastlog->attendancedate,"Y-m-d H:i:s");
                            $checkindate = date_format($firstlog->attendancedate,"Y-m-d");                   
                            //$dated = date_format($firstlog->attendancedate,"Y-m-d");
                            $dated = date("Y-m-d", strtotime($row['from']));
                            $checkindate=$checkindate.' '.$userinfo->staffdetails->starttime;
                            $checkoutdate = date_format($lastlog->attendancedate,"Y-m-d");                   
                            $checkoutdate=$checkoutdate.' '.$userinfo->staffdetails->endtime;
                            
                            echo 'Clock Marked='.$attendancedate;
                            echo "<br>";
                            echo 'Setting Clock In='.$checkindate;
                            echo "<br>";
                            echo 'Setting Clock Out='.$checkoutdate;
                            echo "<br>";
                            $checkin = date_format($firstlog->attendancedate,"H:i:s");
                            $checkout= date_format($lastlog->attendancedate,"H:i:s");
                            $status="P";
                            $tardycount=0;
                            $shortleavecount=0;
                            $paid=1;
                            $remarks="Present";
                            //Get day begins
                            $day = date('D', strtotime($row['from']));
                            $workedhours=0;
                            $to = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $attendancedate);
                            $from = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $attendancedatelast);
                            $workedhours = $to->diffInHours($from,false);
                            //echo $workedhours;
                            
                            //Sunday Check begins
                            if($day=='Sun'){
                                $status="P";
                                $tardycount=0;
                                $shortleavecount=0;
                                $remarks='Sunday';
                                $paid=1;
                            }
                            //Sunday Check ends

                            //Check If today is holiday begins
                            //if($day!='Sun' && $day!='Sat'){
                            if($day!='Sun'){
                                $holiday=\App\Holiday::where('dated', $dated)->first();
                                if(isset($holiday) && $holiday->isworking==0){
                                    $status="H";
                                    $tardycount=0;
                                    $shortleavecount=0;
                                    $remarks=$holiday->description;
                                    $paid=1;
                                }elseif(isset($holiday) && $holiday->isworking==1){
                                    $status="P";
                                    $tardycount=0;
                                    $shortleavecount=0;
                                    $remarks=$holiday->description;
                                    $paid=1;
                                }
                                unset($holiday);
                            }
                            //Check If today is holiday ends
                            


                        }else{
                            //Data not found
                            echo "<br>No Data Found<br>";
                            $day = date('D', strtotime($row['from']));
                            $dated=date('Y-m-d', strtotime($row['from']));
                            $workedhours=0;
                            $checkoutfound="No";
                            $checkin=0;
                            $checkout=0;
                            $status="X";
                            $tardycount=0;
                            $shortleavecount=0;
                            $remarks='Absent';
                            $paid=0;
                            if($day=='Sun'){
                                $status="P";
                                $tardycount=0;
                                $shortleavecount=0;
                                $remarks='Sunday';
                                $paid=1;
                            }
                            //Sunday Check ends

                            //Check If today is holiday begins
                            //if($day!='Sun' && $day!='Sat'){
                            if($day!='Sun'){
                                $holiday=\App\Holiday::where('dated', $dated)->first();
                                $leave=\App\Leave::where('dated', $dated)->where('user_id',$user->id)->where('status','Approved')->first();
                                if(isset($holiday)){
                                    if($holiday->isworking==0){
                                        $status="P";
                                        $remarks=$holiday->description;
                                        $paid=1;
                                    }elseif($holiday->isworking==1){
                                        $status="X";
                                        $remarks="Absent";
                                        $paid=0;
                                    }
                                    //Check If today is Sunday or Public Holiday begins
                                    //$remarks=$holiday->description;
                                    //$status="Holiday";
                                    //Check If today is Sunday or Public Holiday ends
                                }elseif(isset($leave)){
                                    //Check If user is on leave begins
                                    //Check if Paid leave
                                    if($leave->ispaid==1){
                                        $remarks=$leave->leavetype .'-'. $leave->description ;
                                        $status=$leave->leavetype;
                                        $paid=1;
                                    }else{
                                        $remarks=$leave->leavetype .'-'. $leave->description ;
                                        $status='UL';
                                        $paid=0;
                                    }
                                    //Check If user is on leave ends
                                }else{
                                    //Else user is on Absent begins
                                    $remarks="Absent";
                                    $status="X";
                                    $paid=0;
                                    //Else user is on Absent ends
                                } 

                                /*if(isset($holiday) && $holiday->isworking==0){
                                    $status="H";
                                    $tardycount=0;
                                    $shortleavecount=0;
                                    $remarks=$holiday->description;
                                    $paid=1;
                                }elseif(isset($holiday) && $holiday->isworking==1){
                                    $status="P";
                                    $tardycount=0;
                                    $shortleavecount=0;
                                    $remarks=$holiday->description;
                                    $paid=1;
                                }*/
                                unset($holiday);
                            }
                            //Check If today is holiday ends
                        }
                        $joiningdate=\Carbon\Carbon::parse($user->staffdetails->joiningdate);
                        $endingdate=\Carbon\Carbon::parse($user->staffdetails->endingdate);
                        $second= \Carbon\Carbon::parse($dated);    
                        //Check if joining is not reached begins
                        if($joiningdate->greaterThan($second)){
                            $remarks="Not Applicable/Joined";
                            $status="-";
                            $paid=0;
                        }
                        //Check if joining is not reached ends
                        //Check if ending date begins
                        //echo "Ending Date " .$endingdate->lessThanOrEqualTo($second);
                        if($user->staffdetails->endingdate != null && $endingdate->lessThanOrEqualTo($second)){
                            $remarks="Not Applicable/Left";
                            $status="-";
                            $paid=0;
                        }
                        //exit;
                        //Check if ending date ends
                        //Create object and Insert or Update begins

                        //Check if record already exists begins
                        $updateatt=1;
                        $newatt = Attendancesheet::where('user_id',$user->id)->where('dated',$dated)->first();
                        if(empty($newatt)){
                            $newatt = new Attendancesheet;
                        }else{
                            //Check If Att record is 3 days old begins
                            $db_dated=\Carbon\Carbon::parse($newatt->dated);
                            $currentdated= new \Carbon\Carbon();    
                            $diffInDays=$db_dated->diffInDays($currentdated);
                            //echo "Diff In Days to update: ".$diffInDays."<br>";
                            /*if($diffInDays > 6){
                                $updateatt=0;
                            }else{
                                $updateatt=1;
                            }*/
                            //Check If Att record is 3 days old ends
                            //Check if Att record manually updated begins
                            if($newatt->isupdated==1){
                                $updateatt=0;
                            }
                            //Check if Att record manually updated ends
                        }                 
                          
                       
                        //Check if record already exists ends
                        if($updateatt==1 && $dated=='2019-04-30'){
                            $newatt->user_id=$userinfo->id;
                            $newatt->dated=$dated;
                            $newatt->dayname=$day;
                            $newatt->remarks=$remarks;
                            $newatt->paid=$paid;
                            $newatt->attendancedate=$dated;
                            $newatt->checkin=$checkin;
                            $newatt->checkout=$checkout;
                            $newatt->checkoutfound=$checkoutfound;
                            $newatt->tardies=$tardycount;
                            $newatt->shortleaves=$shortleavecount;
                            $newatt->workedhours=$workedhours;
                            $newatt->status=$status;
                            $date=date_create($request->get('date'));
                            $format = date_format($date,"Y-m-d H:i:s");
                            $newatt->created_at = strtotime($format);
                            $newatt->updated_at = strtotime($format);
                            $newatt->save();
                        }
                        //Create object and Insert or Update ends
                    }

                }
                //Check if user Attendance Check is true ends
        }//End foreach
        
    }
//diabhle it after fixing ends





}
