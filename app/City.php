<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class City extends Model
{
    
    public function country(){
        return $this->hasOne(Country::class,'id','country_id')->withDefault();
    }
}
