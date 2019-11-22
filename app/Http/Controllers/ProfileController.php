<?php

namespace App\Http\Controllers;

use App\User;
use App\StaffDetail;
use App\Service;
use App\Certificate;
use Session;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

    public function __construct(){
        $this->middleware('auth')->except('show');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $profile = User::findOrFail(auth()->user()->id);
       $services = Service::where('user_id', auth()->user()->id)->where('is_deleted', 0)->get();
       $certificates = Certificate::where('user_id', auth()->user()->id)->where('is_deleted', 0)->get();
       return view('profile.profile', compact('profile', 'services', 'certificates'));
    }

    public function profile($id){
        $profile = User::findOrFail($id);
        $services = Service::where('user_id', $profile->id)->get();
        return view('profile.profile', compact('profile', 'services'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // dd($id);
        if(auth()->user()->id == $id){
            $profile = User::findOrFail($id);
            return view('profile.edit', compact('profile'));

        }
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([   
            "fname" => 'required|max:50',
            "lname" => 'required|max:50',
            "address" => 'required|max:50',
            "description" => 'required|max:500',
            // "email" => 'required|unique:users|email',
            "phone" => 'required|numeric',
            "image" => 'required',
        ]);

        if($request->hasFile('image')){

            $file = $request->file('image');
            $filename = time() . "-" . $file->getClientOriginalName();
            $path = public_path().'/uploads/profiles/';
            $file->move($path, $filename);
        }

        $user = User::findOrFail(auth()->user()->id);
        // $user->email = $request->email;
        // $user->password = Hash::make($request->get('password'));
       
        $user->avatar = $filename;
        $user->fname = $request->fname;
        $user->lname = $request->lname;
        $user->phonenumber = $request->phone;
        $user->organization_id = 0;
        $user->designation_id = 0;
        $user->role_id = 2; //this is user
        $user->update();

        $profile = StaffDetail::where('user_id', auth()->user()->id)->first();
        $profile->user_id = $user->id;
        // $profile->phone = $request->phone;
        // $profile->gender = $request->gender;
        $profile->update();
        if ($user && $profile){
            return "success";
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
        //
    }

    public function applyPro($id){
        $user = User::findOrFail($id);
        $user->isPro = 2;
        $user->update();
        Session::flash('message', 'You have applied successfully. <script>swal.fire("Applied","You have applied successfully", "success");</script>'); 
        return redirect()->back();
        return redirect(route('PostMy'));
    }
}
