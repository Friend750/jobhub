<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

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
        'professional_summary',
        'is_active',
        'is_connected',
        'interests'
    ];

    public function scopeSearch($query, $value)
    {
        $query->where('user_name', 'like', "%{$value}%")->orWhere('email', 'like', "%{$value}%");
    }


    public function skills()
    {
        return $this->belongsToMany(Skill::class);
    }

    public function languages()
    {
        return $this->belongsToMany(language::class);
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

    public function Links()
    {
        return $this->hasMany(Link::class);
    }

    public function Projects()
    {
        return $this->hasMany(Project::class);
    }

    public function PersonalDetail()
    {
        return $this->hasOne(PersonalDetail::class);
    }

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
}
