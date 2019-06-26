<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LeaveType extends Model
{
    use SoftDeletes;

	const FULL_PAID = 'Full Paid';
	const HALF_PAID = 'Half Paid';
	const NON_PAID = 'None Paid';

	protected $guarded = [];
	
	public function leaves()
	{
		return $this->hasMany('App\Leave');
	}
	
	public function absences()
	{
		return $this->hasMany('App\Absence');
	}

    public function user()
    {
        return $this->belongsTo('App\User','staff_id');
	}

    public function backstopper()
    {
        return $this->belongsTo('App\User','backstopper_id');
    }

    public function staffs()
    {
        return $this->belongsToMany('App\User','leavetype_user','leave_type_id','staff_type_id');
    }

    public function departments()
    {
        return $this->belongsToMany('App\Department','department_leave_type','leave_type_id','department_id');
    }
    public function leavetypes()
    {
        return $this->belongsToMany('App\User','user_leave_type','leave_type_id','user_id');
    }

}
