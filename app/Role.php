<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    const SUPERADMIN = 1;
    CONST ADMIN = 2;


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
