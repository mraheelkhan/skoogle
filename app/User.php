<?php

namespace App;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Yadahan\AuthenticationLog\AuthenticationLogable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Activitylog\Traits\LogsActivity;


class User extends Authenticatable
{
    use  Notifiable; 

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fname', 'lname' , 'email' , 'avatar' ,'status', 'role_id', 'designation_id', 'createdby', 'updatedby'
    ];

    

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

     

    public function role(){
        return $this->hasOne(Role::class, 'id', 'role_id' )->withDefault();
    }

    public function staffdetails(){
        return $this->hasOne(Staffdetail::class, 'user_id', 'id' )->withDefault();
    }
   
    public function designation(){
        return $this->hasOne(Designation::class, 'id', 'designation_id')->withDefault();
    }
 
    public function hasAccess(array $permissions)
    {
        if($this->role->hasAccess($permissions)){
            return true;
        }
        return false;
    }

  
}
