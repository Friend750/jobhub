<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    use HasFactory;
    protected $fillable = [
        'website_name',
        'link',
    ];

    /**
     * Define the relationship with the User model.
     * A link can belong to many users.
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'links_with_user', 'link_id', 'user_id')
                    ->withTimestamps();
    }
}
