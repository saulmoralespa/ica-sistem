<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    protected $fillable = [
        'name','year','enrollment_cost', 'services',
        'r15', 'r1', 'student_id', 'user_id', 'observations'
    ];

    protected $casts = [
        'services' => 'array',
        'r15' => 'array',
        'r1' => 'array'
    ];

    protected $attributes = [
        'r15' => '{}',
        'r1' => '{}'
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
