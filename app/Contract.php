<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    protected $fillable = [
        'enrollment_cost', 'services',
        'student_id', 'user_id', 'observations'
    ];

    public function students()
    {
        return $this->belongsToMany(Student::class);
    }

    public function fees()
    {
        return $this->hasOne(Fee::class);
    }
}
