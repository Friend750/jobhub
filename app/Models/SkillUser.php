<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class SkillUser extends Pivot
{
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'skill_id',
        'user_id',
    ];
}
