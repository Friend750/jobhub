<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class EducationUser extends Pivot
{
    protected $fillable = ['education_id', 'user_id'];

    public function education()
    {
        return $this->belongsTo(Education::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
