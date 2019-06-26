<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RenewContract extends Model
{
    protected $guarded = [];

    public function users()
    {
        return $this->belongsToMany('App\User','renew_contract_user','renew_contract_id','user_id');
    }
}
