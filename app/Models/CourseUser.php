<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CourseUser extends Pivot
{
    protected $fillable = [
        'course_id',
        'user_id',
    ];
    public $timestamps = true;
}
