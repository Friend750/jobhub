<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = 
    [
        'course_name',
        'institution_name',
        'end_date',
        'user_id',
    ];

    
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    /**
     * Define the relationship with the User model.
     * A course can belong to many users.
     */
    
    // public function users()
    // {
    //     return $this->belongsToMany(User::class, 'courses_with_user', 'course_id', 'user_id');
    // }
}
