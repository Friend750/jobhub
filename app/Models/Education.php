<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Education extends Model
{
    use HasFactory,SoftDeletes;


    protected $fillable = ['title', 'describe', 'start_date', 'end_date'];

    
    // public function users()
    // {
    //     return $this->belongsToMany(User::class, 'educations_with_user', 'education_id', 'user_id');
    // }
}
