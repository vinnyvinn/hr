<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TravelRequest extends Model
{
    const APRROVED = 'Approved';
    const DISAPRROVED = 'Disapproved';
    const PENDING = 'Pending approval';
    protected $fillable = ['user_id','travel_perdiem_id','reason',
        'start_date','applied_on','end_date','status'];

}
