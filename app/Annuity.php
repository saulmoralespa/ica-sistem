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

    protected $transDate = false;

    public function getMaximumDateAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/y');
    }

    public function setTransDate($value)
    {
        $this->transDate = $value;
    }

    public function getSecondMonthAttribute($value)
    {
        if (!$this->transDate) {
            $date = new Date($value);
            return $date->englishMonth;
        }else{
            return Carbon::parse($value)->format('d/m/y');
        }
    }
}
