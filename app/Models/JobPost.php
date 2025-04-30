<?php
namespace App\Models;

use App\Traits\HasUserWithDetails;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
class JobPost extends Model
{
    use HasFactory;
    use HasUserWithDetails;
    use SoftDeletes;

    protected $dates = ['deleted_at'];
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
        return $this->belongsTo(User::class);
    }

    // In both Post and JobPost models
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function scopeSearch($query, $value)
    {
        $searchTerm = trim($value); // Remove whitespace from both ends
        $query->where('job_title', 'like', "%{$searchTerm}%");
    }

    public function jobLikes()
    {
        return $this->belongsToMany(JobPost::class, 'job_post_like')->withTimestamps();
    }

    public function scopeForFeed(Builder $query)
    {
        return $query->select([
            'id',
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
            'created_at',
            DB::raw("'job' as type"),
            DB::raw("NULL as content"),
            DB::raw("NULL as post_image"),
        ])
            ->whereNull('deleted_at')
            ->with(['user' => $this->userWithDetailsScope()]);
    }
}
