<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    protected $fillable = [
        'name','year','enrollment_cost', 'services', 'additional_services',
        'r15', 'r1', 'student_id', 'user_id', 'observations'
    ];

    protected $casts = [
        'services' => 'array',
        'additional_services' => 'array',
        'r15' => 'array',
        'r1' => 'array'
    ];

    protected $attributes = [
        'additional_services' => '{}',
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
