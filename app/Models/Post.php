<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'creator',
        'page_id',
        'title',
        'content',
        'post_image',
        'tags',
        'views'
    ];

    /**
     * Define the relationship with the User model.
     * A post is created by a user.
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'creator');
    }

    protected function casts(): array
    {
        return [
            'tags' => 'array'
        ];
    }

    /**
     * Define the relationship with the Page model.
     * A post belongs to a page.
     */
    public function page()
    {
        return $this->belongsTo(Page::class,'page_id');
    }
}
