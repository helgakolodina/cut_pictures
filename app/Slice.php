<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slice extends Model
{
    public function pictures()
    {
      return $this->belongsTo('App\Picture');
    }
}
