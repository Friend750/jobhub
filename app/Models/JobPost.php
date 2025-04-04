<?php
namespace App\Models;

use App\Traits\HasUserWithDetails;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class JobPost extends Model
{
    use HasFactory;
    use HasUserWithDetails;
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
            'is_active',
            'created_at',
            DB::raw("'job' as type"),
            DB::raw("NULL as content"),
            DB::raw("NULL as post_image"),
            DB::raw("NULL as deleted_at")
        ])
            ->where('is_active', true)
            ->with(['user' => $this->userWithDetailsScope()]);
    }
}
