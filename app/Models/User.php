<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'user_name',
        'email',
        'type',
        'password',
        'user_image',
        'is_active',
        'is_connected',
        'interests',
        'google_id',
        'email_verified_at'
    ];

    public function fullName(): string
    {
        // Strict check for non-empty specialist
        if (!empty($this->personal_details?->page_name)) {
            return trim($this->personal_details->page_name);
        }

        // Proceed with name components
        $nameParts = [
            $this->personal_details->first_name ?? '',
            $this->personal_details->last_name ?? ''
        ];

        return trim(implode(' ', $nameParts));
    }

    protected $appends = ['user_image_url']; // Makes it available in JSON responses

    public function getUserImageUrlAttribute()
    {
        if (!$this->user_image) {
            return 'https://ui-avatars.com/api/?name=' . urlencode($this->user_name ?? ' ');
        }

        return str_contains($this->user_image, 'googleusercontent.com')
            ? $this->user_image
            : asset('storage/' . $this->user_image);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function jobPosts()
    {
        return $this->hasMany(JobPost::class);
    }
    public function likes()
    {
        return $this->belongsToMany(Post::class, 'post_like')->withTimestamps();
    }

    public function jobLikes()
    {
        return $this->belongsToMany(JobPost::class, 'job_post_like')->withTimestamps();
    }

    public function likesPost($post)
    {
        return $this->likes()
            ->where('post_id', $post->id)
            ->exists();
    }

    public function likesJobPost($post)
    {
        return $this->jobLikes()
            ->where('job_post_id', $post->id)
            ->exists();
    }

    public function scopeSearch($query, $value)
    {
        $query->where('user_name', 'like', "%{$value}%")->orWhere('email', 'like', "%{$value}%");
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'connections', 'follower_id', 'following_id')
            ->withPivot('is_accepted')
            ->withTimestamps();
    }

    public function followings()
    {
        return $this->belongsToMany(User::class, 'connections', 'following_id', 'follower_id')
            ->withPivot('is_accepted')
            ->withTimestamps();
    }

    public function sameInterests()
    {
        $userInterests = $this->interests;
        return User::where('id', '!=', Auth::id())
            ->where(function ($query) use ($userInterests) {
                foreach ($userInterests as $interest) {
                    $query->orWhereJsonContains('interests', $interest);
                }
            })
            ->with('personal_details')
            ->orderBy('views', 'desc')
            ->get();
    }


    public function acceptedFollowers()
    {
        return $this->followers()
            ->wherePivot('is_accepted', 1)
            ->where('type', '!=', 'company');
    }

    public function acceptedAllFollowers()
    {
        return $this->followers()
            ->wherePivot('is_accepted', 1);
    }

    public function acceptedFollowings()
    {
        return $this->followings()
            ->wherePivot('is_accepted', 1)
            ->where('type', '!=', 'company');
    }


    public function companies()
    {
        return $this->belongsToMany(User::class, 'connections', 'following_id', 'follower_id')
            ->where('type', 'company')
            ->withPivot('is_accepted');
    }




    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'skill_user', 'user_id', 'skill_id');
    }

    public function languages()
    {
        return $this->belongsToMany(language::class, 'language_user', 'user_id', 'language_id');
    }

    public function Experiences()
    {
        return $this->hasMany(Experience::class);
    }

    public function Courses()
    {
        return $this->hasMany(Course::class);
    }

    public function Educations()
    {
        return $this->hasMany(Education::class);
    }

    public function Projects()
    {
        return $this->hasMany(Project::class);
    }

    public function personal_details()
    {
        return $this->hasOne(PersonalDetail::class, 'user_id');
    }
    public function connections()
    {
        return $this->hasMany(Connection::class, 'follower_id');
    }

    public function getProfilePictureAttribute()
    {
        return $this->attributes['profile_picture']
            ? $this->attributes['profile_picture']
            : 'https://ui-avatars.com/api/?name=Image';
    }

    public function links()
    {
        return $this->belongsToMany(Link::class, 'link_user', 'user_id', 'link_id')
            ->withTimestamps(); // If you want to use the timestamps in the pivot table
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    // Conversation.php


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'interests' => 'array'
        ];
    }

    public function receivesBroadcastNotificationsOn(): string
    {
        return 'users.' . $this->id;
    }
}
