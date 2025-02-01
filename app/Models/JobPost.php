<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobPost extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'job_title', 'about_job', 'job_tasks',
        'job_conditions', 'job_skills', 'job_location',
        'job_timing', 'tags', 'target', 'is_active',
        'job_post', 'views'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopeSearch($query, $term)
{
    return $query->where('job_title', 'LIKE', "%{$term}%")
                 ->orWhere('job_location', 'LIKE', "%{$term}%")
                 ->orWhere('tags', 'LIKE', "%{$term}%");
}
public function creator()
{
    return $this->belongsTo(User::class, 'user_id'); // Replace 'creator_id' with the actual foreign key
}

}
