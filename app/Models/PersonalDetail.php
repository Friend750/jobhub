<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'first_name',
        'last_name',
        'job_title',
        'email',
        'phone',
        'city',
    ];

    /**
     * Define the relationship with the User model.
     * A personal detail belongs to a user.
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'personal_details_with_user', 'personal_detail_id', 'user_id')
                    ->withTimestamps();
    }
}
