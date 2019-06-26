<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TravelPlan extends Model
{
    protected $guarded = [];
    const STATUS_PENDING = 'Pending';
    const STATUS_APPROVED = 'Approved';
    const STATUS_REJECTED = 'Rejected';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
