<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReplyComment extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'comment_id', 'content'];

    // Relationship: Each reply belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship: Each reply belongs to a comment
    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }
}
