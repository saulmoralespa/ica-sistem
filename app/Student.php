<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    const ACTIVE = 1;
    const INACTIVE = 2;
    const DISCOUNTINUED = 3;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'idPersonal', 'attendant', 'phone'
    ];

    public function contracts()
    {
        return $this->hasMany(Contract::class);
    }
}
