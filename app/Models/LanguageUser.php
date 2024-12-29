<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class LanguageUser extends Pivot
{
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'language_id',
        'user_id',
    ];
}
