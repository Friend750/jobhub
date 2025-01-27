<div

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
    <div
        class="row flex-grow-1 overflow-hidden"
        x-data
        x-init="
             console.log('Echo initialized');
    let channel = Echo.private('users.{{ auth()->user()->id }}');
    channel.notification((notification) => {
        if (notification.type === 'App\\Notifications\\SentMessage') {
            $wire.dispatch('messageReceived');
        }
        });
        "
    >
        <!-- Side Chat List -->
        <div
        class="col-md-4 border-end chat-list d-flex flex-column h-100"
        id="chat-list"
        :class="isMobile && selectedChat ? 'd-none' : ''"
        style="/* يمكنك استخدام calc(...) أو min-height: 100vh مثلاً بحسب تصميمك */"
    >
        <h4 class="mb-3 mt-3 px-3">Chats</h4>

        <!-- قائمة المحادثات -->
        <ul class="list-unstyled flex-grow-1 overflow-auto m-0">
            @foreach($chats as $chat)
                <li
                    class="d-flex align-items-center p-2 border-bottom"
                    @click="
                        $wire.selectChat({{ $chat['id'] }});
                        selectedChat = true;
                        $nextTick(() => scrollToBottom());
                    "
                    style="cursor: pointer;"
                >
                    <img
                        src="https://via.placeholder.com/35?text=User"
                        alt="Profile Picture"
                        class="profile-picture rounded-circle mr-2"
                    >
                    <div class="w-100">
                        <strong>{{ $chat['name'] }}</strong>
                        <p
                            class="text-muted m-0 text-truncate"
                            style="max-width: 12ch; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"
                        >
                            {{ $chat['last_message'] }}
                        </p>
                    </div>
                </li>
            @endforeach
        </ul>

        <!-- زر إضافة دردشة جديدة في الأسفل -->
        <div class="p-3 border-top">
            <a href="/Followers" >   <button class="btn btn-primary w-100">
                START NEW CHAT
            </button> </a>
        </div>

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
                <div
                x-data="{
                    previousScrollHeight: 0,
                    saveScrollPosition() {
                        this.previousScrollHeight = this.$refs.messagesContainer.scrollHeight;
                    },
                    restoreScrollPosition() {
                        const container = this.$refs.messagesContainer;
                        const newScrollHeight = container.scrollHeight;
                        container.scrollTop = newScrollHeight - this.previousScrollHeight;
                    }
                }"
                class="chat-container d-flex flex-column flex-grow-1 overflow-hidden">
                    <!-- Messages Area -->
                    <div
                    @scroll.passive="
                    if ($refs.messagesContainer.scrollTop === 0) {
                        saveScrollPosition(); // حفظ موقع التمرير
                       $wire.loadMessages().then(() => restoreScrollPosition());
                    }"
                        x-init="scrollToBottom()"
                        class="flex-grow-1 overflow-auto p-3 chat-messages-area"
                        x-ref="messagesContainer"
                    >
                        @foreach($messages as $message)
                            @php
                                // افتراض أنك تريد التحقق إن كنت أنت المرسل
                                $isSender = $message['sender_id'] == auth()->user()->id;
                            @endphp

                            <div class="d-flex {{ $isSender ? 'justify-content-end' : 'justify-content-start' }} mb-3">
                                <div
                                    class="message p-2 rounded
                                           {{ $isSender ? 'bg-white text-dark' : 'btn-primary text-white' }}"
                                >
                                    {{ $message['message'] }}
                                </div>
                                <div class="text-muted small mt-1 ml-2">
                                    {{ date('h:i A', strtotime($message['created_at'])) }}
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Input Section -->
                    <div class="chat-input-section p-3 border-top">
                        <form
                            wire:submit.prevent="sendMessage"
                            @submit="$nextTick(() => scrollToBottom())"
                        >
                            
                            <div class="input-group">
                                <input
                                    wire:model="message"
                                    type="text"
                                    class="form-control"
                                    placeholder="Write your message"
                                    @focus="$nextTick(() => scrollToBottom())"
                                />

                                <button
                                    class="btn btn-primary text-white ml-2"
                                    type="submit"
                                >
                                    <i class="fa-regular fa-paper-plane"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            @else
                <p class="text-center text-muted flex-grow-1 d-flex align-items-center justify-content-center">
                    Choose a Chat to start
                </p>
            @endif
        </div>
    </div>
    <span id="app" data-user-id="{{ auth()->id() }}"></span>
</div>
