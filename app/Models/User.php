<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    use HasFactory;

    protected $fillable = [
        'email',
        'email_verified_at',
        'user_name',
        'password',
        'user_image',
        'professional_summary',
    ];

    public function chats()
    {
        return $this->hasMany(Chat::class, 'sender_id');
    }

    public function conversations()
    {
        return $this->hasMany(Conversation::class, 'first_chat')->orWhere('second_chat', $this->id);
    }

    public function educationUsers()
    {
        return $this->hasMany(EducationUser::class);
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
        ];
    }
}
