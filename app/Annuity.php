<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Jenssegers\Date\Date;

class Annuity extends Model
{
    protected $fillable = [
        'year', 'cost', 'discount',
        'maximum_date', 'second_month'
    ];

    protected $casts = [
        'maximum_date' => 'date:d/m/y'
    ];

    public function getSecondMonthAttribute($value)
    {
        $date = new Date($value);
        return $date->englishMonth;
}
}
