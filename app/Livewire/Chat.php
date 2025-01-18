<?php

namespace App\Livewire;

use App\Models\Conversation;
use App\Models\User;
use App\Notifications\SentMessage;
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
    public $paginateVar =10;

    public function mount()
    {  
        
        $this->chats = Conversation::with(['firstUser', 'secondUser'])
        ->orderBy('updated_at', 'desc') // ترتيب المحادثات حسب آخر تحديث
        ->take(5) // جلب أول 5 محادثات
        ->get()
        ->map(function ($conversation) {
            return [
                'id' => $conversation->id,
                'name' => auth()->id() === $conversation->first_user 
                            ? $conversation->secondUser->user_name 
                            : $conversation->firstUser->user_name, // عرض اسم الشخص الآخر
                'last_message' => $conversation->last_message,
                'profile' => 'default-profile.png', // يمكنك تخصيص صورة الملف الشخصي هنا
            ];
        })            
        ->toArray();  
        $this->currentUserId = auth()->id(); // تخزين معرف المستخدم الحالي
        
    }


    // protected $listeners = 
    // [
    //     'loadMore' => 'loadMore',
    // ];
   

    public function sendMessage()
{
    $this->validate([
        'message' => 'required|string|max:1000',
    ]);
    $conversation = \App\Models\Conversation::find($this->selectedChat['id']);
    $receiverId = auth()->id() === $conversation->first_user 
? $conversation->second_user // إذا كان المستخدم الحالي هو الأول، اجعل المستقبل هو الثاني
: $conversation->first_user;
    $message = \App\Models\Chat::create([
        'message' => $this->message,
        'sender_id' => auth()->id(),
        'receiver_id' => $receiverId, // إذا كان المستخدم الحالي هو الثاني، اجعل المستقبل هو الأول
        'conversation_id' => $this->selectedChat['id'],
    ]);

// dd(auth()->user() .' ' .$message.' ' . $conversation.' ' . $receiverId);

   $this->messages[] = $message->toArray();
    $this->getUserById($receiverId)->notify(new SentMessage( auth()->user(),$message,$conversation,$receiverId));

    

   

    $this->message = '';
}


public function getUserById($receiverId)
{
    return User::find($receiverId)->first(); // جلب كائن User باستخدام المعرف
}



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
        ->get()
        ->toArray();

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
        ->values()
        ->toArray();

    // تحديث عدد الرسائل المحملة
    $this->paginateVar += count($newMessages);

    // إضافة الرسائل الجديدة إلى الرسائل الحالية
    $this->messages = array_merge($newMessages, $this->messages);

    return $newMessages;
}


public function selectChat($chatId)
{
    $this->selectedChat = collect($this->chats)->firstWhere('id', $chatId);

    // عدد الرسائل المحملة مبدئيًا
    $this->paginateVar = 10;

    // تحميل أول 10 رسائل
    $this->messages = \App\Models\Chat::where('conversation_id', $this->selectedChat)
        ->orderBy('created_at', 'desc') // ترتيب عكسي للحصول على الأحدث أولاً
        ->take($this->paginateVar)
        ->get()
        ->sortBy('created_at') // إعادة ترتيب الرسائل ليصبح الأقدم أولاً
        ->values()
        ->toArray();
}


    public function render()
    {
        return view('livewire.chat');
    }
}

