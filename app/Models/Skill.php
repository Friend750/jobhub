<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Skill extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = 
    [
        'name',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
    /**
     * Define the relationship with the User model.
     * A skill can belong to many users.
     */
   
}
