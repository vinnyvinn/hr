<?php

namespace Letters\Models;

use Illuminate\Database\Eloquent\Model;

class Offered extends Model
{
      protected $fillable=['candidate_id','title','template','attachement'];
}
