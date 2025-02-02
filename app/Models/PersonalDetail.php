<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PersonalDetail extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'first_name',
        'last_name',
        'page_name',
        'specialist',
        'professional_summary',
        'phone',
        'city'
    ];



    public function user()
    {
        return $this->belongsTo(User::class);
    }
    /**
     * Define the relationship with the User model.
     * A personal detail belongs to a user.
     */

}
