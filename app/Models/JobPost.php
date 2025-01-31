<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobPost extends Model
{
    use HasFactory;
    protected $fillable =
    [
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
        'views'
    ];

    public function user_id()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    protected function casts(): array
    {
        return
        [
            'tags' => 'array'
        ];
    }
}
