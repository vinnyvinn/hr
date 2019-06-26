<?php

namespace Letters\Models;

use Illuminate\Database\Eloquent\Model;

class IssuedWarning extends Model
{
    

    public function user(){

    	return $this->belongsTo('App\User');
    }
}
