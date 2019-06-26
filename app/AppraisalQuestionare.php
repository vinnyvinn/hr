<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AppraisalQuestionare extends Model
{
    protected $fillable = ['department_id','name','questions','designation_id'];



    public function department(){

    	$this->belongsTo('App\Department', 'id', 'department_id');
    }
}
