<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'user_created',
        'page_id',
        'title',
        'content',
        'post_image',
        'job_post',
    ];

    /**
     * Define the relationship with the User model.
     * A post is created by a user.
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'user_created');
    }

    /**
     * Define the relationship with the Page model.
     * A post belongs to a page.
     */
    public function page()
    {
        return $this->belongsTo(Page::class);
    }
}
