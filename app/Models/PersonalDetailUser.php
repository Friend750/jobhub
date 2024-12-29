<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class PersonalDetailUser extends Pivot
{
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'personal_detail_id',
        'user_id',
    ];

    public function personaldetail()
    {
        return $this->belongsTo(PersonalDetail::class,'personal_detail_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
