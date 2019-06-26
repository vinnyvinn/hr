<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AppraisalProcess extends Model
{
    protected $guarded =[];

    const STATUS_PENDING = 'pending';
    const STATUS_APPROVED = 'approved';
    const STATUS_REJECTED = 'rejected';
    const STATUS_ACCEPTED = 'accepted';
    const STATUS_CANCELLED = 'cancelled';
    function user(){
        return $this->belongsTo(User::class);
    }
    function template(){
        return $this->belongsTo(AppraisalTemplate::class);
    }
}
