<?php

namespace App\Livewire;

use App\Models\Conversation;
use App\Models\User;
use App\Notifications\SentMessage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;


use function Illuminate\Log\log;

class Chat extends Component
{
    public $chats = []; // قائمة الدردشات
    public $selectedChat = null; // المحادثة المختارة
    public $message; // الرسائل
    public $messages = []; // الرسائل
    public $newMessage = false; // لتحديد إذا كانت هناك رسالة جديدة
    public $currentUserId; // معرف المستخدم الحالي

    protected $listeners = ['messageReceived' => 'loadNewMessages'];
    public $paginateVar = 10;


    public function mount($conversationId = null)
{
    // تخزين معرف المستخدم الحالي مرة واحدة
    $this->currentUserId = Auth::id();

    $this->chats = \App\Models\Conversation::query()
        // 1) تحديد الأعمدة المطلوبة فقط لتقليل الحمل
        ->select(['id', 'first_user', 'second_user', 'last_message', 'updated_at'])

        // 2) eager load للعلاقات المتداخلة (users + personalDetails) لتجنب N+1
        ->with([
            'firstUser:id,user_name,user_image',
            'firstUser.personal_details:id,user_id,first_name,last_name,page_name,specialist',
            'secondUser:id,user_name,user_image',
            'secondUser.personal_details:id,user_id,first_name,last_name,page_name,specialist',
        ])

        // 3) فلترة: المستخدم الحالي لازم يكون طرف في المحادثة
        ->where(function ($q) {
            $q->where('first_user', $this->currentUserId)
              ->orWhere('second_user', $this->currentUserId);
        })

        // 4) ترتيب وحدّ أعلى داخل SQL
        ->orderByDesc('updated_at')
        ->limit(5)
        ->get()

        // 5) تجهيز البيانات للعرض (Business Logic في Laravel)
        ->map(function ($conversation) {
            // نحدد الطرف الآخر
           $otherUser = $conversation->getOtherUser($this->currentUserId);

            return [
                'id'           => $conversation->id,
                'name'         => method_exists($otherUser, 'fullName')
                                  ? $otherUser->fullName()
                                  : ($otherUser->user_name ?? ''),
                'profile'      => $otherUser->user_image_url ?? $otherUser->user_image ?? null,
                'specialist'   => data_get($otherUser, 'personal_details.specialist'),
                'last_message' => $conversation->last_message,
            ];
        })
        ->toArray();

    // إذا تم تمرير conversationId
    if ($conversationId != null) {
        $conversation = Conversation::findOrFail($conversationId);

        // التحقق من الصلاحية
        $this->authorize('view', $conversation);

        $this->selectChat($conversationId);
    }
}




    public function sendMessage()
    {
        $this->validate([
            'message' => 'required|string|max:60000',
        ]);
        $conversation = Conversation::findOrFail($this->selectedChat['id']);

        $this->authorize('sendMessage', $conversation);
        $receiverId = Auth::id() === $conversation->first_user
            ? $conversation->second_user // إذا كان المستخدم الحالي هو الأول، اجعل المستقبل هو الثاني
            : $conversation->first_user;
      if (!User::where('id', $receiverId)->exists()) {
    abort(404, 'Receiver not found');
}


       DB::transaction(function () use ($conversation, $receiverId) {
    $message = \App\Models\Chat::create([
        'message' => $this->message,
        'sender_id' => $this->currentUserId,
        'receiver_id' => $receiverId,
        'conversation_id' => $this->selectedChat['id'],
    ]);

    $conversation->update([
        'last_message' => $this->message,
    ]);

    $this->messages[] = $message;

    $receiver = User::findOrFail($receiverId);
    $receiver->notify(new SentMessage(Auth::user(), $message, $conversation, $receiver->id));
});

$this->message = '';
    }

    //trigger_error("🚨 Deprecated: Use calculateDiscount() instead.", E_USER_DEPRECATED);
    /**
     *
     * */




    public function loadNewMessages()
    {
        // احصل على معرف آخر رسالة حالية في القائمة
        $lastMessageId = end($this->messages)['id'] ?? null;

        if (!$lastMessageId) {
            return []; // لا توجد رسائل لتحميلها
        }

        // تحميل الرسائل الجديدة فقط
        $newMessages = \App\Models\Chat::where('conversation_id', $this->selectedChat)
            ->where('id', '>', $lastMessageId) // جلب الرسائل التي معرفها أكبر من آخر رسالة
            ->orderBy('created_at', 'asc') // ترتيب حسب الأقدمية
            ->get()
            ->toArray();

        // دمج الرسائل الجديدة مع الرسائل الحالية
        $this->messages = array_merge($this->messages, $newMessages);

        // إرجاع الرسائل الجديدة إذا لزم الأمر
        return $newMessages;
    }

public function loadPreviousMessages()
{
    $totalMessages = \App\Models\Chat::where('conversation_id', $this->selectedChat)->count();

    if ($this->paginateVar >= $totalMessages) {
        return [];
    }

    $newMessages = \App\Models\Chat::with(['sender:id,user_name,user_image'])
        ->where('conversation_id', $this->selectedChat)
        ->latest('created_at') // نفس orderByDesc
        ->skip($totalMessages - $this->paginateVar - 10)
        ->take(10)
        ->get()
        ->sortBy('created_at')
        ->values();

    if ($newMessages->isNotEmpty()) {
        $this->paginateVar += $newMessages->count();
        $this->messages = $newMessages->toArray() + $this->messages;
    }

    return $newMessages;
}


    public function selectChat($chatId)
    {
        $this->message = '';
        $this->selectedChat = collect($this->chats)->firstWhere('id', $chatId);

        // عدد الرسائل المحملة مبدئيًا
        $this->paginateVar = 10;

        // تحميل أول 10 رسائل
        $this->messages = \App\Models\Chat::where('conversation_id', $this->selectedChat)
            ->orderBy('created_at', 'desc') // ترتيب عكسي للحصول على الأحدث أولاً
            ->take($this->paginateVar)
            ->get()
            ->values()
            ->toArray();
    }


    public function render()
    {
        return view('livewire.chat');
    }
}
