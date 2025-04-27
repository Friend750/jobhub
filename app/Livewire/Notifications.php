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
    public $perPage = 10;
    public $hasMoreNotifications = true; // افترض أنه لديك هذا المتغير


    public function mount()
    {
        $this->loadNotifications();
        $this->statistics = [
            'lastPostViews' => Auth::user()->posts()->latest()->first(),
            'postViews' => Auth::user()->posts()->sum('views'),
            'profileViews' => Auth::user()->views,
        ];
    }

    public function loadMore()
    {
        $this->perPage += 10;
        $this->loadNotifications();
    }
    public function loadNotifications()
    {
        $userId = Auth::id();

        // تحميل الإشعارات من قاعدة البيانات
        $notifications = DB::table('notifications')
            ->where('notifiable_id', $userId)
            ->where('type', '!=', 'App\\Notifications\\SentMessage')
            ->orderBy('created_at', 'desc')
            ->get()
            ->filter(function ($notification) {
                $data = json_decode($notification->data, true);

                if (isset($data['user']['id']) && isset($data['receiverId'])) {
                    return $data['user']['id'] != $data['receiverId'];
                }

                return true; // إذا لم يكن هناك شرط، نعيد الإشعار كما هو
            })
            ->map(function ($notification) {
                $data = json_decode($notification->data, true);

                return [
                    'id' => $notification->id,
                    'type' => $notification->type,
                    'read_at' => $notification->read_at,
                    'data' => $data,
                ];
            });

        // تحديد عدد الإشعارات التي سيتم إرجاعها بناءً على قيمة perPage
        $loadedNotifications = $notifications->take($this->perPage);

        // تحديث الإشعارات في الكائن
        $this->notifications = $loadedNotifications;

        // التحقق إذا كان هناك المزيد من الإشعارات لتحميلها
        if ($loadedNotifications->count() < $this->perPage) {
            $this->hasMoreNotifications = false; // لا توجد إشعارات أخرى لتحميلها
        } else {
            $this->hasMoreNotifications = true; // هناك إشعارات أخرى لتحميلها
        }
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
