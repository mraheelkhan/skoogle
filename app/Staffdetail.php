<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Staffdetail extends Model
{
   

    protected $fillable = [
        'user_id', 
        'phonenumber', 'dob','cnic',
        'skypeid',
    ];

    


    protected $dates = [
        'dob',
        'created_at',
        'updated_at'
    ];
    
    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id' );
    }
    
    
}
