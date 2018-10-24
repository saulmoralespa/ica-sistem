<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    protected $fillable = [
        'name','year','enrollment_cost', 'services',
        'student_id', 'user_id', 'observations'
    ];

    public function students()
    {
        return $this->belongsToMany(Student::class);
    }

    public function fee()
    {
        return $this->hasOne(Fee::class);
    }

}
