<?php

namespace App\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Title;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class Notifications extends Component
{
    #[Title('Notifications')]

    public $statistics = [];
    public $notifications = [];

    public function mount()
    {
        $this->loadNotifications();
        $this->statistics = [
            'lastPostViews' =>  Auth::user()->posts()->latest()->first(),
            'postViews' => Auth::user()->posts()->sum('views'),
            'profileViews' => Auth::user()->views,
        ];
}


public function loadNotifications()
{
    $userId = auth()->id(); // الحصول على معرف المستخدم الحالي
    $this->notifications = DB::table('notifications')
            ->where('notifiable_id', $userId) // جلب الإشعارات للمستخدم الحالي فقط
            ->where('type', '!=', 'App\\Notifications\\SentMessage') // استثناء النوع غير المطلوب
            ->get()
            ->map(function ($notification) {
                $data = json_decode($notification->data, true); // فك JSON
                $user = \App\Models\User::find($data['user_id']); // الحصول على المستخدم
                return [
                    'id' => $notification->id,
                    'type' => $notification->type,
                    'read_at' => $notification->read_at,
                    'data' => $data,
                    'user_name' => $user ? $user->user_name : 'Unknown User', // إضافة اسم المستخدم
                ];
            });
}
public function markAsRead($id)
{

    DB::table('notifications')
        ->where('id', $id)
        ->update(['read_at' => Carbon::now('Asia/Aden')]);
    $this->loadNotifications(); // تحديث الإشعارات بعد التغيير
}

public function acceptRequest($senderId, $receiverId, $notificationId)
{
    // البحث عن الاتصال في جدول connections
    $connection = DB::table('connections')
        ->where('following_id', $senderId)
        ->where('follower_id', $receiverId)
        ->first();

    if ($connection) {
        // تحديث حالة الاتصال إلى مقبول
        DB::table('connections')
            ->where('id', $connection->id)
            ->update(['is_accepted' => 1]);
    }

    // حذف الإشعار من جدول notifications
    DB::table('notifications')->where('id', $notificationId)->delete();

    // إعادة تحميل الإشعارات لتحديث الواجهة
    $this->loadNotifications();
}

public function declineRequest($senderId, $receiverId, $notificationId)
{
    // البحث عن الاتصال في جدول connections
    $connection = DB::table('connections')
        ->where('following_id', $senderId)
        ->where('follower_id', $receiverId)
        ->first();

    if ($connection) {
        // تحديث حالة الاتصال إلى مقبول
        DB::table('connections')
            ->where('id', $connection->id)
            ->delete();
    }

    // حذف الإشعار من جدول notifications
    DB::table('notifications')->where('id', $notificationId)->delete();

    // إعادة تحميل الإشعارات لتحديث الواجهة
    $this->loadNotifications();
}

    public function render()
    {
        return view('livewire.notifications');
    }
}
