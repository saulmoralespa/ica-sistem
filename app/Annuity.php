<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Annuity extends Model
{
    protected $fillable = [
        'year', 'cost', 'discount',
        'maximum_date', 'second_month'
    ];

    protected $casts = [
        'maximum_date' => 'date:d/m/y',
        'second_month' => 'date:F'
    ];
}
