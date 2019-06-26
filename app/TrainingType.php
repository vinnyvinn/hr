<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrainingType extends Model
{
    protected $fillable = ['name','description'];

    public function training()
    {
        return $this->hasMany(Training::class,'training_type_id','id');
    }
}
