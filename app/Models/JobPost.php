<?php

// namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;

// class JobPost extends Model
// {
//     use HasFactory;

//     protected $fillable = [
//         'user_id',
//         'job_title',
//         'about_job',
//         'job_tasks',
//         'job_conditions',
//         'job_skills',
//         'job_location',
//         'job_timing',
//         'tags',
//         'is_active',
//         'job_post',
//         'views'
//     ];

//     protected $casts = [
//         'tags' => 'array',
//         'job_skills' => 'array',
//         'is_active' => 'boolean',
//         'start_date' => 'date',
//         'end_date' => 'date',

//     ];

//     public function user()
//     {
//         return $this->belongsTo(User::class)->select('id', 'user_name');
//     }

//     public function scopeSearch($query, $term)
//     {
//         return $query->where('job_title', 'LIKE', "%{$term}%")
//             ->orWhere('job_location', 'LIKE', "%{$term}%")
//             ->orWhereRaw("JSON_CONTAINS(tags, '\"$term\"')");
//     }
// }


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobPost extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'job_title',
        'about_job',
        'job_tasks',
        'job_conditions',
        'job_skills',
        'job_location',
        'job_timing',
        'tags',
        'target',
        'is_active',
        'job_post',
        'views',
    ];

    protected $casts = [
        'tags' => 'array',
        'is_active' => 'boolean',
    ];

    public function user()
        {
            return $this->belongsTo(User::class)->select('id', 'user_name');
        }
    
        public function scopeSearch($query, $term)
        {
            return $query->where('job_title', 'LIKE', "%{$term}%")
                ->orWhere('job_location', 'LIKE', "%{$term}%")
                ->orWhereRaw("JSON_CONTAINS(tags, '\"$term\"')");
        }
}
