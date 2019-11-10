<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Session;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = '/home';
    public function redirectTo(){
        
        // User role
        $role = Auth::user()->role_id; 
        $status = Auth::user()->status;

        
        if($status == 0){
            Auth::logout();
            Session::flash('message', '<script>swal.fire("Your not Authorize","Your Account is not yet Activated, Please contact your Administrator","error");</script>'); 
            return '/'; 
        }
        // Check user role
        switch ($role) {
            case 1:
            case 3:
                    return '/dashboard';
                break;
            case 2:
                    return '/home';
                break; 
            default:
                    return '/home';
                    Session::flash('message', '<script>swal.fire("You are not Authorize","Your Account belongs to Mobile Application, Please login from Mobile","error");</script>'); 
                    return Auth::logout(); 
                break;
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
