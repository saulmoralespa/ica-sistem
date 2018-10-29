<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
    protected $fillable = [
        'contract_id', 'fees'
    ];

    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }
}
