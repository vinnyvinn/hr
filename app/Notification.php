<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    const TRAVEL_ADMIN = 'travel_admin';
    const TRAVEL_EMPLOYEE = 'travel_employee';
    protected $fillable = ['from_id','to_id','type','action','message','status'];

    public function fromuser()
    {
        $this->belongsTo(User::class,'id','from_id');
    }
    public function touser()
    {
        $this->belongsTo(User::class,'id','to_id');
    }
}
