<?php
use App\User;
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use DB;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=\App\User::where('iscustomer',1)->get();
        return view('customers.customers',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customers.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->hasfile('avatar-1'))
         {
            $file = $request->file('avatar-1');
            $avatarname = time().$file->getClientOriginalName();
            $file->move(public_path().'/img/staff', $avatarname);
         }else{
            $avatarname="default_avatar_male.jpg";
         }
         
        $this->validate(request(), [
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'phonenumber' => 'required'
        ]);

        $user= new \App\User;
        $user->fname=$request->get('fname');
        $user->lname=$request->get('lname');
        $user->email=$request->get('email');
        $user->iscustomer=1;
        $user->password=Hash::make($request->get('password'));
        $user->phonenumber=$request->get('phonenumber');
        $date=date_create($request->get('date'));
        $format = date_format($date,"Y-m-d");
        $user->created_at = strtotime($format);
        $user->updated_at = strtotime($format);
        $user->avatar = $avatarname;
        $user->save();
        return redirect('customers/create')->with('success', 'Staff has been created successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user      =  \App\User::with('role')->where('id',$id)->first();
        $loginlogs =  \App\User::find($id)->authentications;
        //Email Phone address book
		$addressbooks = \App\Addressbook::with('createdby')->where('user_id',$id)->where('type',1)->get();
		$addressbooksphone = \App\Addressbook::with('createdby')->where('user_id',$id)->where('type',2)->get();
        return view('customers.show',compact('user','loginlogs','addressbooks','addressbooksphone'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user  =  \App\User::where('id',$id)->where('iscustomer',1)->first();
        //dd($user);

        return view('customers.edit',compact('user','id'));
    }

    //For Reset Password
    public function resetPassword($id)
    {
        $user  = \App\User::find($id);
        return view('customers.resetpassword',compact('user','id'));
    }
    //For Deactivate
    public function deactivate($id)
    {
        $user =   \App\User::find($id);         
        $user->status=2;
        $date=now();
        $format = date_format($date,"Y-m-d");
        $user->updated_at = strtotime($format);
        $user->save();
        return redirect()->action(
            'CustomerController@index'
        )->with('success', 'Staff status has been deactivated.');
    }
    //For Active
    public function active($id)
    {
        $user =   \App\User::find($id);         
        $user->status=1;
        $date=now();
        $format = date_format($date,"Y-m-d");
        $user->updated_at = strtotime($format);
        $user->save();
        return redirect()->action(
            'CustomerController@index'
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
        
        $this->authorize('edit-customer');
        if($request->get('changepassword')){
        //Change Password
        
            $user =  \App\User::find($id); 
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
            
            return redirect()->action(
                'CustomerController@resetPassword', ['id' => $user->id]
            )->with('success', 'Password has been reset.');
        }else{
        //Update Staff/User details
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
                'phonenumber' => 'required'
            ]);
            
            
            $user->fname=$request->get('fname');
            $user->lname=$request->get('lname');
            $user->email=$request->get('email');
            $user->iscustomer=1;
            $user->phonenumber=$request->get('phonenumber');
            if(!$request->get('profile')){
            $user->status=$request->get('status');
            }
            $date=date_create($request->get('date'));
            $format = date_format($date,"Y-m-d");
            $user->updated_at = strtotime($format);
            if(isset($avatarname)){
                $user->avatar = $avatarname;
            }
            $user->save();
            if($request->get('profile')){
                $message='Profile details has been updated.';
            }else{
                $message='Customer details has been updated';
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
            $user = \App\User::find($id);
            $user->delete();
            return redirect()->action(
                'CustomerController@index' 
            )->with('success', 'Customer has been deleted.');
        } catch(\Illuminate\Database\QueryException $ex){ 
            return redirect()->action(
                'CustomerController@index' 
            )->with('failed', 'Unable to delete, this CUSTOMER has linked record(s) in system.');
            //$ex->getMessage()
        }
    }
}
