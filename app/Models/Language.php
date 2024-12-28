<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;
    protected $fillable = [
        'language',
    ];

    /**
     * Define the relationship with the User model.
     * A language can belong to many users.
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'languages_with_user', 'language_id', 'user_id')
                    ->withTimestamps();
    }
}
