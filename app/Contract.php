<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    protected $guarded = [];

    public function users()
    {
        return $this->belongsToMany('App\User','contract_user','contract_id','user_id');
    }

    public function template()
    {
        return $this->belongsTo('App\ContractTemplate','template_id','id');
    }
}
