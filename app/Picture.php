<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    public function slices()
    {
        return $this->hasMany('App\Slice');
    }
}
