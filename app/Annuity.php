<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Annuity extends Model
{
    protected $fillable = [
        'year', 'cost', 'discount',
        'maximum_data', 'second_month'
    ];
}
