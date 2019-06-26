<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = ['user_id','vehicle_type','vehicle_number','vehicle_model','vehicle_description'
    ,'vehicle_purchase_date'];

    public function getVehiclePurchaseDateAttribute($vehicledate)
    {
        return Carbon::parse($vehicledate)->format('m/d/Y');
    }
    public function setVehiclePurchaseDateAttribute($vehicledate)
    {
        $this->attributes['vehicle_purchase_date'] = Carbon::parse($vehicledate);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
