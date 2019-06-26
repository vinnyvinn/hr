<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AppraisalMaster extends Model
{
    protected $guarded = [];

    const STATUS_NEW='NEW';
    const STATUS_CANCELLED = 'CANCELLED';
    const STATUS_COMPLETE = 'COMPLETE';
    const STATUS_WIP = 'WIP';

    function template(){
        return $this->belongsTo(AppraisalTemplate::class);
    }
    function department(){
        return $this->belongsTo(Department::class);
    }
    function designation_item(){
      return $this->belongsTo(DesignationItem::class,'designation_id');
    }
}
