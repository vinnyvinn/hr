<?php

namespace App;

use willvincent\Rateable\Rateable;
use Illuminate\Database\Eloquent\Model;

class AppraisalQuestion extends Model
{

   protected $guarded = [];
    use Rateable;

    
    public function questiontype(){
    	//return $this->belongsTo('App\QuestionType','question_type_id');
    }
}
