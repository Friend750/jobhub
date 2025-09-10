<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

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
   public function getOtherUser(?int $userId = null)
{
    $userId = $userId ?? Auth::id(); // إذا لم يُمرر، استخدم المستخدم الحالي

    if ($this->firstUser && $this->secondUser)
        {
        return $this->first_user == Auth::id() ? $this->secondUser : $this->firstUser;
        }
    return null;
}



public static function betweenUsers(int $userId1, int $userId2): Conversation
{
    // البحث عن محادثة موجودة بين المستخدمين
    $conversation = self::where(function ($query) use ($userId1, $userId2) {
        $query->where('first_user', $userId1)
              ->where('second_user', $userId2);
    })
    ->orWhere(function ($query) use ($userId1, $userId2) {
        $query->where('first_user', $userId2)
              ->where('second_user', $userId1);
    })
    ->first();

    // إذا لم توجد، إنشاء محادثة جديدة
    if (!$conversation) {
        $conversation = self::create([
            'first_user'  => $userId1,
            'second_user' => $userId2,
        ]);
    }

    return $conversation;
}



}
