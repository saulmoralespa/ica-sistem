<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    CONST ADMIN = 1;
    CONST TEACHER = 2;
    CONST STUDENT = 3;

    public function user()
    {

    }
}
