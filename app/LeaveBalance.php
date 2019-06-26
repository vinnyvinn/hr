<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LeaveBalance extends Model
{
    protected $guarded = [];


    public function staff()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function leave_type()
    {
        return $this->belongsTo(LeaveType::class,'leave_type_id','id');
    }


}
