<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable =
    [
        'user_id',
        'title',
        'description',
        'contributions'
    ];

    public function user()
    {
        return $this->belongsTo(User::class)->select('id','user_name','user_image');
    }

}
