<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class LinkUser extends Pivot
{
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'link_id',
        'user_id',
    ];
}
