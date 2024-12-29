<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interest extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
    ];

    /**
     * Define the relationship with the User model.
     * An interest can belong to many users.
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'interests_users', 'interest_id', 'user_id')
                    ->withTimestamps();
    }
}
