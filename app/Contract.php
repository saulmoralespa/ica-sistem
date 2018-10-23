<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    public function students()
    {
        return $this->belongsToMany(Student::class);
    }

    public function fees()
    {
        return $this->hasOne(Fee::class);
    }
}
