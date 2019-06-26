<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hierachy extends Model
{
    protected $guarded = [];

    function users(){
        return $this->belongsToMany('App\User','hierachy_user','user_id','hirachy_id');
    }

    function staff(){
        return $this->belongsTo('App\User','user_id','id');
    }
    function manager(){
        return $this->belongsTo('App\User','manager_id','id');
    }
    function supervisor(){
        return $this->belongsTo('App\User','supervisor_id','id');
    }

}
