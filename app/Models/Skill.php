<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
    ];

    /**
     * Define the relationship with the User model.
     * A skill can belong to many users.
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'skills_with_user', 'skill_id', 'user_id')
                    ->withTimestamps();
    }
}
