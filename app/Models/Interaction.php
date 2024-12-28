<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'post_id',
        'type',
        'comment',
    ];

    /**
     * Define the relationship with the User model.
     * An interaction belongs to a user.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Define the relationship with the Post model.
     * An interaction belongs to a post.
     */
    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }
}
