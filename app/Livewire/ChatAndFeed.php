<?php

namespace App\Livewire;

use App\Livewire\Traits\ConnectionTrait;
use App\Models\Connection;
use App\Models\Conversation;
use App\Models\User;
use App\Notifications\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ChatAndFeed extends Component
{
    use ConnectionTrait;

    public $chats;
    public $suggestions;
    protected int $sidebarLimit = 3;

    public function mount()
    {
        $this->loadChats();
        $this->loadSuggestions();
    }

   public function loadChats()
{
    $this->chats = Conversation::with([
        'firstUser:id,user_name,user_image',
        'firstUser.personal_details',
        'secondUser:id,user_name,user_image',
        'secondUser.personal_details'
    ])
    ->where(function ($query) {
        $query->where('first_user', Auth::id())
              ->orWhere('second_user', Auth::id());
    })
    ->orderBy('updated_at', 'desc')
    ->take($this->sidebarLimit)
    ->get(['id', 'first_user', 'second_user', 'last_message'])
    ->map(function ($conversation) {
        $otherUser = $conversation->getOtherUser();

        // إذا لم يكن هناك مستخدم آخر، استخدم بيانات افتراضية
        if (!$otherUser) {
            return [
                'id' => $conversation->id,
                'last_message' => $conversation->last_message,
                'profile' => '',
                'full_name' => 'Unknown User',
            ];
        }

        return [
            'id' => $conversation->id,
            'last_message' => $conversation->last_message,
            'profile' => $otherUser->user_image_url ?? '',
            'full_name' => $otherUser->fullName() ?? '',
        ];
    })
    ->toArray();
}




    public function loadSuggestions()
{
    $user = Auth::user();
    $userInterests = $user->interests;

    // الاستعلام الأساسي
    $query = User::query()
        ->where('id', '!=', $user->id) // استبعد المستخدم نفسه
        ->whereDoesntHave('connections', function ($q) use ($user) {
            $q->where('following_id', $user->id);
        })
        ->with('personal_details')
        ->orderByDesc('views');

    // إذا لدى المستخدم اهتمامات، اضف شرط الاهتمامات
    if (!empty($userInterests)) {
        $query->where(function ($q) use ($userInterests) {
            foreach ($userInterests as $interest) {
                $q->orWhereJsonContains('interests', $interest);
            }
        });
    }

    // جلب النتائج
    $this->suggestions = $query->take($this->sidebarLimit)->get();

    // fallback: إذا لم يتم العثور على أي اقتراحات بناءً على الاهتمامات
    if ($this->suggestions->isEmpty()) {
        $this->suggestions = User::query()
            ->where('id', '!=', $user->id)
            ->whereDoesntHave('connections', function ($q) use ($user) {
                $q->where('following_id', $user->id);
            })
            ->with('personal_details')
            ->orderByDesc('views')
            ->take($this->sidebarLimit)
            ->get();
    }
}




    public function render()
    {
        return view('livewire.chat-and-feed');
    }
}
