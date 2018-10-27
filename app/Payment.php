<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function getDateDepositAttribute($value){
        return Carbon::parse($value)->format('d/m/y');
    }
}
