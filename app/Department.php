<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use SoftDeletes;
	
	protected $dates = ['deleted_at'];
	
	protected $fillable = [
		'department',
		'employee_id',
        'first_name',
        'last_name'
	];
	
	public function users()
	{
		return $this->hasMany('App\User');
	}
	
	public function department()
	{
		return $this->belongsTo('App\Department');
	}
	
	public function designation_items()
	{
		return $this->hasMany('App\DesignationItem');
	}
	public function questionares()
	{
		$this->hasMany('App\AppraisalQuestionare', 'department_id' , 'id');
	}

    public function sub_departments()
    {
        return $this->hasMany('App\SubDepartment','department_id','id');
	}
}
