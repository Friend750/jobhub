<?php

namespace App\Models;

use App\Traits\HasUserWithDetails;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Post extends Model
{
    use HasFactory, SoftDeletes;
    use HasUserWithDetails;

    protected $fillable = [
        'user_id',
        'page_id',
        'content',
        'post_image',
        'tags',
        'target',
        'views'
    ];


    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    protected function casts(): array
    {
        return [
            'tags' => 'array'
        ];
    }


    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likes(){
        return $this->belongsToMany(User::class,'post_like')->withTimestamps();
    }

    public function personalDetails()
    {
        return $this->hasOneThrough(
            PersonalDetail::class,
            User::class,
            'id',          // Foreign key on the users table (users.id)
            'user_id',     // Foreign key on personal_details table (personal_details.user_id)
            'user_id',     // Local key on posts table (posts.user_id)
            'id'           // Local key on users table (users.id)
        );
    }

    public function scopeForFeed(Builder $query)
    {
        return $query->select([
            'id',
            'user_id',
            DB::raw("NULL as job_title"),
            DB::raw("NULL as about_job"),
            DB::raw("NULL as job_tasks"),
            DB::raw("NULL as job_conditions"),
            DB::raw("NULL as job_skills"),
            DB::raw("NULL as job_location"),
            DB::raw("NULL as job_timing"),
            'tags',
            'target',
            DB::raw("NULL as is_active"),
            'created_at',
            DB::raw("'post' as type"),
            'content',
            'post_image',
            'deleted_at'
        ])
            ->whereNull('deleted_at')
            ->with(['user' => $this->userWithDetailsScope()]);

    }

}
