@push('styles')
<link rel="stylesheet" href="{{ asset('css/chat.css') }}">
<link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
<link rel="stylesheet" href="{{ asset('css/search.css') }}">
@endpush

<div class="big-container" x-data="{
    selectedChat: null,
    isMobile: window.innerWidth <= 768,
    scrollToBottom() {
        const container = this.$refs.messagesContainer;
        if (container) {
            container.scrollTop = container.scrollHeight;
        }
    }
}" @resize.window="isMobile = window.innerWidth <= 768" style="margin-top: 5.2rem !important;">
    <div class="row flex-grow-1 overflow-hidden" x-data x-init="console.log('Echo initialized');
    let channel = Echo.private('users.{{ auth()->user()->id }}');
    channel.notification((notification) => {
        if (notification.type === 'App\\Notifications\\SentMessage') {
            $wire.dispatch('messageReceived');
        }
    });">
        <!-- Side Chat List -->
        <div class="col-md-3 border-end chat-list d-flex flex-column h-100" id="chat-list"
            :class="isMobile && selectedChat ? 'd-none' : ''" style="min-height: 100vh">
            <h4 class="mb-3 mt-3 px-3">{{ __('general.chats') }}</h4>

            {{-- If no chats exist, show the button right below the header --}}
            @if(count($chats) === 0)
            <div class="p-3 border-top">
                <a href="/Followers">
                    <button class="btn btn-primary w-100">
                        {{ __('general.start_new_chat') }}
                    </button>
                </a>
            </div>
            @endif

            {{-- Chat List --}}
            <ul class="list-unstyled flex-grow-1 overflow-auto m-0">
                @foreach ($chats as $chat)
                <li class="d-flex align-items-center p-2 border-bottom" @click="
                       $wire.selectChat({{ $chat['id'] }});
                       selectedChat = true;
                       $nextTick(() => scrollToBottom());
                   " style="cursor: pointer;">
                    <img src="{{ $chat['profile'] ?? 'https://ui-avatars.com/api/?name=Image' }}" style="width: 40px"
                        class="profile-picture rounded-circle ms-2 me-2">
                    <div class="w-100">
                        <strong>{{ $chat['name'] }}</strong>
                        <p class="text-muted m-0 text-truncate"
                            style="max-width: 12ch; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                            {{ $chat['last_message'] }}
                        </p>
                    </div>
                </li>
                @endforeach
            </ul>

            {{-- If chats exist, show the button at the bottom --}}
            @if(count($chats) > 0)
            <div class="p-3 border-top">
                <a href="/Followers">
                    <button class="btn btn-primary w-100">
                        {{ __('general.start_new_chat') }}
                    </button>
                </a>
            </div>
            @endif
        </div>


        <!-- Chat Messages -->
        <div class="col-md-8 d-flex flex-column ms-2" id="chat-messages">
            @if ($selectedChat)
            <!-- Chat Header -->
            <div class="d-flex justify-content-between align-items-center p-1 border-bottom">
                <div>
                    <img class="profile-picture rounded-circle mr-2">
                    <strong>{{ __('general.chat_with') }} {{ $selectedChat['name'] }}</strong>
                </div>
            </div>

            <!-- Scrollable Chat Messages with Input -->
            <div x-data="{
                    previousScrollHeight: 0,
                    saveScrollPosition() {
                        this.previousScrollHeight = this.$refs.messagesContainer.scrollHeight;
                    },
                    restoreScrollPosition() {
                        const container = this.$refs.messagesContainer;
                        const newScrollHeight = container.scrollHeight;
                        container.scrollTop = newScrollHeight - this.previousScrollHeight;
                    }
                }" class="chat-container d-flex flex-column flex-grow-1 overflow-hidden">
                <!-- Messages Area -->
                <div @scroll.passive="
                    if ($refs.messagesContainer.scrollTop === 0) {
                        saveScrollPosition();
                        $wire.loadMessages().then(() => restoreScrollPosition());
                    }" x-init="scrollToBottom()" class=" flex-grow-1 overflow-auto p-3 chat-messages-area"
                    x-ref="messagesContainer">
                    @foreach ($messages as $message)
                    @php
                    $isSender = $message['sender_id'] == auth()->user()->id;
                    @endphp

                    <div class="d-flex {{ $isSender ? 'justify-content-end' : 'justify-content-start' }} mb-3">
                        <div class="message p-2 rounded
                                           {{ $isSender ? 'bg-white text-dark' : 'btn-primary text-white' }} ">
                            {{ $message['message'] }}
                        </div>
                        <div class="text-muted small me-2 mt-1 ">
                            {{ date('h:i A', strtotime($message['created_at'])) }}
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Input Section -->
                <div class="chat-input-section p-3 border-top">
                    <form wire:submit.prevent="sendMessage" @submit="$nextTick(() => scrollToBottom())">
                        @csrf
                        <div class="input-group">
                            <input wire:model="message" type="text" class="form-control"
                                placeholder="{{ __('general.write_message') }}"
                                @focus="$nextTick(() => scrollToBottom())" />

                            <button class="btn btn-primary text-white me-2" type="submit">
                                <i class="fa-regular fa-paper-plane"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            @else
            <p class="text-center text-muted flex-grow-1 d-flex align-items-center justify-content-center">
                {{ __('general.choose_chat') }}
            </p>
            @endif
        </div>
    </div>
</div>
