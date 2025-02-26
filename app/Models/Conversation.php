<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Conversation extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['first_user','second_user','chat_id', 'last_message',];

    public function chat()
    {
        return $this->hasMany(Chat::class, 'chat_id');
    }

    public function firstUser()
    {
        return $this->belongsTo(User::class, 'first_user');
    }
    public function secondUser()
    {
        return $this->belongsTo(User::class, 'second_user');
    }
    public function getOtherUser()
{
    return $this->first_user == auth()->id()
        ? $this->secondUser
        : $this->firstUser;
}

}
