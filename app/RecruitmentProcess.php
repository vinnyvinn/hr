<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RecruitmentProcess extends Model
{
    protected $fillable = ['recruitment_type_id','process','start_date','end_date'];
    public function recruit_type()
    {
        return $this->belongsTo(RecruitmentType::class,'recruitment_type_id','id');
    }
}
