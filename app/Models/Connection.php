<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Connection extends Model
{

    use HasFactory,SoftDeletes;
    protected $fillable =
    [
    'following_id','follower_id','is_accepted'
    ];


    public function following()
    {
        return $this->belongsTo(User::class,'following_id');
    }


    public function follower()
    {
        return $this->belongsTo(User::class,'follower_id');
    }
}
