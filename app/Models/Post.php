<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'page_id',
        'title',
        'content',
        'post_image',
        'tags',
        'views'
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    protected function casts(): array
    {
        return [
            'tags' => 'array'
        ];
    }

    public function page()
    {
        return $this->belongsTo(Page::class, 'page_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function personalDetails()
    {
        return $this->hasOneThrough(
            PersonalDetail::class,
            User::class
        );
    }}
