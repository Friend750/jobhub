<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = ['content', 'user_id', 'post_id', 'parent_id'];

    public function commentable()
    {
        return $this->morphTo()->withTrashed();
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    // public function post(){
    //     return $this->belongsTo(Post::class);
    // }

    // التعليق عنده ردود
    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    // التعليق ممكن يكون رد على تعليق آخر
    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }
}
