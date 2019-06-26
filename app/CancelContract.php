<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CancelContract extends Model
{
    protected $guarded = [];

    public function users()
    {
        return $this->belongsToMany('App\User','cancel_contract_user','cancel_contract_id','user_id');
    }

    public function reasons()
    {
        return $this->belongsTo(Reason::class,'reason','id');
    }
}
