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

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
