<div class="container mt-4 col-6">
    <div class="row">
        <!-- القائمة الجانبية -->
        <div class="col-md-4 border-end">
            <h4 class="mb-3">Chats</h4>
            <ul class="list-unstyled">
                @foreach($chats as $chat)
                    <li 
                        class="d-flex align-items-center p-2 border-bottom" 
                        wire:click="selectChat({{ $chat['id'] }})" 
                        style="cursor: pointer;"
                    >
                        <img 
                            src="{{ asset('images/' . $chat['profile']) }}" 
                            alt="Avatar" 
                            class="rounded-circle me-3 mr-2 flex-shrink-0" 
                            width="50" 
                            height="50"
                        >
                        <div class="w-100">
                            <strong>{{ $chat['name'] }}</strong>
                            <p class="text-muted m-0 text-truncate" style="max-width: 12ch; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                {{ $chat['last_message'] }}
                            </p>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
        <!-- شاشة الرسائل -->
        <div class="col-md-8">
            @if($selectedChat)
            <img 
            src="{{ asset('images/' . $chat['profile']) }}" 
            alt="Avatar" 
            class="rounded-circle me-3 mr-2 flex-shrink-0" 
            width="50" 
            height="50"
        >
                <div class="chat-container">
                    @foreach($messages as $message)
                    <div class="d-flex {{ $message['from_me'] ? 'justify-content-end' : 'justify-content-start' }} mb-3">
                        <div 
                            class="message {{ $message['from_me'] ? 'from-me' : 'from-them' }}"
                        >
                            {{ $message['text'] }}
                        </div>
                        <div class="text-muted small mt-1 ml-2">{{ $message['time'] }}</div>
                    </div>
                    @endforeach
                </div>
                <div class="input-group mb-2">
                    <input 
                        type="text" 
                        class="form-control" 
                        placeholder="Write your message"
                    >
                    <button 
                        class="btn btn-primary text-white" 
                        type="button"
                    >
                        <i class="fa-regular fa-paper-plane"></i>
                    </button>
                </div>
            @else
                <p class="text-center text-muted flex-grow-1 d-flex align-items-center justify-content-center">
                    Choose a Chat to start
                </p>
            @endif
        </div>
    </div>
</div>
