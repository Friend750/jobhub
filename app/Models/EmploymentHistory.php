<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmploymentHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_title',
        'employer',
        'start_date',
        'end_date',
        'describe',
    ];

    /**
     * Define the relationship with the User model.
     * Employment history belongs to a user.
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'employment_histories_with_user', 'employment_history_id', 'user_id');
    }
}
