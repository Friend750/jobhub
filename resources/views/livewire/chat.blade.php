<div 
    class="container-fluid vh-100 d-flex flex-column" 
    x-data="{
        selectedChat: null,
        isMobile: window.innerWidth <= 768,
        scrollToBottom() {
            const container = this.$refs.messagesContainer;
            if (container) {
                container.scrollTop = container.scrollHeight;
            }
        }
    }" 
    @resize.window="isMobile = window.innerWidth <= 768"
>
    <div class="row flex-grow-1 overflow-hidden">
        <!-- Side Chat List -->
        <div 
            class="col-md-4 border-end chat-list d-flex flex-column" 
            id="chat-list" 
            :class="isMobile && selectedChat ? 'd-none' : ''"
        >
            <h4 class="mb-3 mt-3 px-3">Chats</h4>
            <ul class="list-unstyled flex-grow-1 overflow-auto px-3">
                @foreach($chats as $chat)
                    <li 
                        class="d-flex align-items-center p-2 border-bottom" 
                        @click="$wire.selectChat({{ $chat['id'] }}); selectedChat = true; $nextTick(() => scrollToBottom())" 
                        style="cursor: pointer;"
                    >
                        <img 
                            src="https://via.placeholder.com/35?text=User" 
                            alt="Profile Picture"
                            class="profile-picture rounded-circle mr-2"
                        >
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
        </div>

        <!-- Chat Messages -->
        <div 
            class="col-md-8 d-flex flex-column" 
            id="chat-messages"
        >
            @if($selectedChat)
            <!-- Chat Header -->
            <div class="d-flex justify-content-between align-items-center p-1 border-bottom">
                <div>
                    <img 
                        src="https://via.placeholder.com/35?text=User" 
                        alt="Profile Picture"
                        class="profile-picture rounded-circle mr-2"
                    >
                    <strong>{{ $selectedChat['name'] }}</strong>
                </div>
            </div>

            <!-- Scrollable Chat Messages with Input -->
            <div class="chat-container d-flex flex-column flex-grow-1 overflow-hidden">
                <!-- Messages Area -->
                <div 
                    class="flex-grow-1 overflow-auto p-3 chat-messages-area" 
                    x-ref="messagesContainer"
                >
                    @foreach($messages as $message)
                    <div 
                        class="d-flex {{ $message['from_me'] ? 'justify-content-end' : 'justify-content-start' }} mb-3"
                    >
                        <div 
                            class="message {{ $message['from_me'] ? 'from-me' : 'from-them' }}"
                        >
                            {{ $message['text'] }}
                        </div>
                        <div class="text-muted small mt-1 ml-2">{{ $message['time'] }}</div>
                    </div>
                    @endforeach
                </div>

                <!-- Input Section -->
                <div class="chat-input-section p-3 border-top">
                    <div class="input-group">
                        <input 
                            type="text" 
                            class="form-control" 
                            placeholder="Write your message"
                            @focus="$nextTick(() => scrollToBottom())"
                        >
                        <button 
                            class="btn btn-primary text-white ml-2" 
                            type="button"
                            @click="$wire.sendMessage(); $nextTick(() => scrollToBottom())"
                        >
                            <i class="fa-regular fa-paper-plane"></i>
                        </button>
                    </div>
                </div>
            </div>
            @else
            <p class="text-center text-muted flex-grow-1 d-flex align-items-center justify-content-center">
                Choose a Chat to start
            </p>
            @endif
        </div>
    </div>
</div>
