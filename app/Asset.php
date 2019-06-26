<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    protected $guarded = [];

    public function asset_type()
    {
        return $this->belongsTo('App\AssetType');
    }
}
