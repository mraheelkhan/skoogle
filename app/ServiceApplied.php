<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceApplied extends Model
{
    protected $fillable = ['user_id', 'service_id'];
    
    public function user(){
        return $this->belongsTo(User::class)->withDefault();
    }
    public function service(){
        return $this->hasMany(Service::class)->withDefault();
    }
}
