<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Escalation extends Model
{
    
    protected $fillable=['candidate_id','recruitment_id','comment','process_id','application_status','esc_status'];

    

    public function candidate(){
		return $this->belongsTo(Candidate::class,'candidate_id','id');
	}


	public function process(){

		return $this->hasMany(RecruitmentProcess::class,'id','process_id');
	}

	public function application(){

		return $this->belongsTo('Letters\Models\AppicationStatus','application_status','id');
	}
}
