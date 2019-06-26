<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LeaveDay extends Model
{
    protected $fillable = ['user_id','leave_type_id','leaves_no','remaining_leaves','can_exceed_limit'];
}
