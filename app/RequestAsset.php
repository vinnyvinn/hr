<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestAsset extends Model
{
    protected $guarded = [];

    public function asset()
    {
        return $this->belongsTo('App\Asset');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
