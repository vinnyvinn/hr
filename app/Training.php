<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    protected $fillable = ['training_type_id','description','start_date','end_date'];
    public function training_type()
    {
        return $this->belongsTo(TrainingType::class,'training_type_id','id');
    }
}
