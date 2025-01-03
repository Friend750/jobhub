<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Education extends Model
{
    use HasFactory,SoftDeletes;



    protected $fillable = 
    [
    'institution_name',
     'certification_name', 
     'location', 
     'degree',
     'description',
     'graduation_date',
     'user_id'
    ];

    
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    // public function users()
    // {
    //     return $this->belongsToMany(User::class, 'educations_with_user', 'education_id', 'user_id');
    // }
}
