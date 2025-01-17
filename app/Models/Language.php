<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Language extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = 
    [
        'language',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * Define the relationship with the User model.
     * A language can belong to many users.
     */
    
}
