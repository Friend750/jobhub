<?php

namespace App\Livewire;

use App\Models\Connection;
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
            'lastPostViews' => Auth::user()->posts()->latest()->first(),
            'postViews' => Auth::user()->posts()->sum('views'),
            'profileViews' => Auth::user()->views,
        ];
    }


    public function loadNotifications()
    {
        $userId = Auth::id(); // الحصول على معرف المستخدم الحالي
        $this->notifications = DB::table('notifications')
            ->where('notifiable_id', $userId) // جلب الإشعارات للمستخدم الحالي فقط
            ->where('type', '!=', 'App\\Notifications\\SentMessage') // استثناء النوع غير المطلوب
            ->orderBy('created_at', 'desc') // ترتيب الإشعارات حسب تاريخ الإنشاء
            ->get()
            ->map(function ($notification) {
                $data = json_decode($notification->data, true); // فك JSON
                $user = \App\Models\User::find($data['user']['id']); // الحصول على المستخدم
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

    public function markAllAsRead()
    {
        DB::table('notifications')
            ->where('notifiable_id', Auth::id()) // Filter notifications by the authenticated user
            ->update(['read_at' => Carbon::now('Asia/Aden')]);

        $this->loadNotifications(); // Refresh notifications after updating
    }

    public function acceptRequest($senderId, $receiverId, $notificationId)
    {
        $connection = Connection::where('following_id', $senderId)
            ->where('follower_id', $receiverId)
            ->first();

        if ($connection) {
            $connection->update(['is_accepted' => 1]);
        }

        DB::table('notifications')->where('id', $notificationId)->delete();

        // إعادة تحميل الإشعارات لتحديث الواجهة
        $this->loadNotifications();
    }

    public function declineRequest($senderId, $receiverId, $notificationId)
    {
        $connection = Connection::where('following_id', $senderId)
            ->where('follower_id', $receiverId)
            ->first();

        if ($connection) {
            $connection->delete();
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
