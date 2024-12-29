<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'user_id',
    ];

    /**
     * Define the relationship with the User model.
     * A page belongs to a user (owner).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Define the relationship with the Post model.
     * A page can have many posts.
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
