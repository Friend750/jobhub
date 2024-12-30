<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Interest extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'name',
    ];

    /**
     * Define the relationship with the User model.
     * An interest can belong to many users.
     */
   
}
