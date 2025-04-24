<?php

namespace App\Livewire;

use App\Models\Conversation;
use App\Models\User;
use App\Notifications\SentMessage;
use Illuminate\Support\Facades\Auth;
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

    protected $listeners = ['messageReceived' => 'loadMore'];
    public $paginateVar = 10;


    public function mount($conversationId = null)
    {

        $this->currentUserId = Auth::id(); // تخزين معرف المستخدم الحالي

        $this->chats = Conversation::with([
            'firstUser:id,user_name,user_image',
            'secondUser:id,user_name,user_image'
        ])
            ->where(function ($query) {
                $query->where('first_user', Auth::id())
                    ->orWhere('second_user', Auth::id());
            }) // Only fetch conversations where the user is a participant
            ->orderBy('updated_at', 'desc')
            ->take(5)
            ->get(['id', 'first_user', 'second_user', 'last_message'])
            ->map(function ($conversation) {
                $otherUser = Auth::id() === $conversation->first_user
                    ? $conversation->secondUser
                    : $conversation->firstUser;


                return [
                    'id' => $conversation->id,
                    'name' => $otherUser->fullName(),
                    'last_message' => $conversation->last_message,
                    'profile' => $otherUser->user_image_url,
                    'specialist' => $otherUser->personal_details->specialist,
                ];
            })
            ->toArray();

        if ($conversationId != null) {
            $conversation = Conversation::findOrFail($conversationId);

            // Use policy to check access
            $this->authorize('view', $conversation);

            $this->selectChat($conversationId);
        }
    }


    public function isUserPartOfConversation($conversation)
    {
        if ($conversation->firstUser->id === $this->currentUserId || $conversation->secondUser->id === $this->currentUserId) {
            // Auth user is either firstUser or secondUser
            return true;
        } else {
            // Auth user is not part of the conversation
            return false;
        }
    }

    public function sendMessage()
    {
        $this->validate([
            'message' => 'required|string|max:1000',
        ]);
        $conversation = Conversation::findOrFail($this->selectedChat['id']);

        $this->authorize('sendMessage', $conversation);
        $receiverId = Auth::id() === $conversation->first_user
            ? $conversation->second_user // إذا كان المستخدم الحالي هو الأول، اجعل المستقبل هو الثاني
            : $conversation->first_user;
        if (!User::find($receiverId)) {
            abort(404, 'Receiver not found');
        }
        $message = \App\Models\Chat::create([
            'message' => $this->message,
            'sender_id' => Auth::id(),
            'receiver_id' => $receiverId, // إذا كان المستخدم الحالي هو الثاني، اجعل المستقبل هو الأول
            'conversation_id' => $this->selectedChat['id'],
        ]);
        $conversation->update([
            'last_message' => $this->message,
        ]);

        // dd(auth()->user() .' ' .$message.' ' . $conversation.' ' . $receiverId);

        $this->messages[] = $message;
        User::find($receiverId)->notify(new SentMessage(Auth::user(), $message, $conversation, $receiverId));





        $this->message = '';
    }

    //trigger_error("🚨 Deprecated: Use calculateDiscount() instead.", E_USER_DEPRECATED);
    /**
     *
     * */




    public function loadMore()
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
            ->get()->toArray();

        // دمج الرسائل الجديدة مع الرسائل الحالية
        $this->messages = array_merge($this->messages, $newMessages);

        // إرجاع الرسائل الجديدة إذا لزم الأمر
        return $newMessages;
    }

    public function loadMessages()
    {
        // عدد الرسائل الإجمالي في المحادثة
        $totalMessages = \App\Models\Chat::where('conversation_id', $this->selectedChat)->count();

        // التحقق إذا كان هناك رسائل متبقية لتحميلها
        if ($this->paginateVar >= $totalMessages) {
            return []; // لا توجد رسائل إضافية
        }

        // تحميل الرسائل المتبقية
        $newMessages = \App\Models\Chat::where('conversation_id', $this->selectedChat)
            ->orderBy('created_at', 'desc') // ترتيب عكسي
            ->skip($totalMessages - $this->paginateVar - 10) // تجاوز الرسائل المحملة
            ->take(10) // تحميل 10 رسائل فقط
            ->get()
            ->sortBy('created_at') // إعادة الترتيب ليصبح الأقدم أولاً
            ->values()->toArray();

        if (count($newMessages) > 0) {
            // زيادة العدد الإجمالي للرسائل
            $this->paginateVar += count($newMessages);

            // إضافة الرسائل الجديدة إلى الرسائل الحالية
            $this->messages = array_merge($newMessages, $this->messages);
        } else {
            // لا توجد رسائل إضافية
            // يمكن تنفيذ إجراء إضافي هنا إذا لزم الأمر
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
            ->sortBy('created_at') // إعادة ترتيب الرسائل ليصبح الأقدم أولاً
            ->values()->toArray();
    }


    public function render()
    {
        return view('livewire.chat');
    }
}
