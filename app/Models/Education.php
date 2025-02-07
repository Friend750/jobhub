<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Education extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'educations'; // Ensures Laravel queries the correct table
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

    protected $casts = [
        'graduation_date' => 'date',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
