<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    const HIGHSCHOOL = 'highschool';
    const PROFESSIONAL = 'professional';
    const UNIVERSITY = 'university';
    protected $fillable = ['type','education_title','education_grade','education_institution'
    ,'start_date','end_date'];

    public function user()
    {
        return $this->belongsTo('App/User');
    }
}
