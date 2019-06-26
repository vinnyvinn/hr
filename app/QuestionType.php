<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionType extends Model
{
    const NUMERIC = 'Numeric';
    const TEXT = 'Text';
    const STARS = 'Stars';
    const TRUE_FALSE = 'True /False';

    public function appraisalquestions(){

    	$this->hasMany('App\AppraisalQuestion');
    }
}
