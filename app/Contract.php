<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    public function student()
    {
        return $this->belongsToMany('App\Student');
    }
}
