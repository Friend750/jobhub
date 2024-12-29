<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Link extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'website_name',
        'link',
    ];

    /**
     * Define the relationship with the User model.
     * A link can belong to many users.
     */
   
}
