<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TravelPerdiem extends Model
{
    protected $guarded = [];

    public function departments()
    {
        return $this->belongsTo(Department::class,'department_id','id');
    }
    public function travelmode()
    {
        return $this->belongsTo(TravelMode::class,'travel_mode_id','id');
    }
}
