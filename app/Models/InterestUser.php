<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InterestUser extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'interest_id',
        'user_id',
    ];
    public function interest()
    {
        return $this->belongsTo(Interest::class, 'interest_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
