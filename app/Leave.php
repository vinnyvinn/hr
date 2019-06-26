<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Carbon\Carbon;

class Leave extends Model
{
    use SoftDeletes;
	protected $guarded = [];

	public function user()
	{
		return $this->belongsTo('App\User');
	}
    public function staff()
    {
        return $this->belongsTo('App\User','staff_id','id');
    }
	
	public function leave_type()
	{
		return $this->belongsTo('App\LeaveType');
	}

	public function setDateFromAttribute($date){
		$this->attributes['date_from'] = Carbon::parse($date);
	}
	
	public function getDateFromAttribute($date){
		return Carbon::parse($date)->format('m/d/Y');
	}
	
	public function setDateToAttribute($date){
		$this->attributes['date_to'] = Carbon::parse($date);
	}
	
	public function getDateToAttribute($date){
		return Carbon::parse($date)->format('m/d/Y');
	}
	
	public function setAppliedOnAttribute($date){
		$this->attributes['applied_on'] = Carbon::parse($date);
	}
	
	public function getAppliedOnAttribute($date){
		return Carbon::parse($date)->format('m/d/Y');
	}
	
	public function getStatusAttribute($status){
		return $status == 0 ? 'Pending Approval' : ($status == 1 ? 'Approved' : 'Rejected');
	}
}
