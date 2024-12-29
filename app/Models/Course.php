<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $fillable = [
        'course_name',
        'institution',
        'start_date',
        'end_date',
    ];

    /**
     * Define the relationship with the User model.
     * A course can belong to many users.
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'courses_with_user', 'course_id', 'user_id');
    }
}
