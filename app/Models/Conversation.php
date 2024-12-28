<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;

    protected $fillable = ['first_chat', 'second_chat', 'last_message', 'image_first_chat', 'image_second_chat'];

    public function firstChat()
    {
        return $this->belongsTo(User::class, 'first_chat');
    }

    public function secondChat()
    {
        return $this->belongsTo(User::class, 'second_chat');
    }
}
