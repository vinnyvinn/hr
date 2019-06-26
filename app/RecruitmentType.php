<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RecruitmentType extends Model
{
    protected $fillable = ['name','description'];

    public function process()
    {
        return $this->hasMany(RecruitmentProcess::class,'recruitment_type_id','id');
    }

    
}
