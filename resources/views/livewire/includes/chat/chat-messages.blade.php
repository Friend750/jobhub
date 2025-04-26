<div class="col-md-9 d-flex flex-column" id="chat-messages">
    @if ($selectedChat)

        <!-- Scrollable Chat Messages with Input -->
        <div x-data="chatMessages" class="chat-container d-flex flex-column flex-grow-1 overflow-hidden rounded-0">
            <!-- Chat Header -->
            <div class="d-flex flex-column justify-content-between align-items-start p-1 border-bottom py-3">
                <strong class="h5 mb-0">{{ $selectedChat['name'] }}</strong>

                <small class="text-muted" style="
            font-size: smaller;
                ">
                    {{ $selectedChat['specialist'] ?? 'specialist' }}</small>
            </div>

            <!-- Messages Area -->
            <div @scroll.passive="handleScroll($refs.messagesContainer)" x-init="scrollToBottom()"
                class="  flex-grow-1 overflow-auto p-3 chat-messages-area rounded" x-ref="messagesContainer">
                @foreach ($messages as $message)
                    @php
                        $isSender = $message['sender_id'] == auth()->user()->id;
                    @endphp

                    <div class="d-flex {{ $isSender ? 'justify-content-end' : 'justify-content-start' }} mb-3">
                        <div
                            class="message p-2 rounded shadow-sm {{ $isSender ? 'bg-white text-dark' : 'btn-primary text-white' }} ">
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
                <form class="comment-form" wire:submit.prevent="sendMessage"
    @submit="$nextTick(() => scrollToBottom())" x-data>

    <div class="textarea-container">
        <textarea class="form-control comment-input rounded"
            wire:model="message" rows="1"
            placeholder="{{ __('general.write_message') }}"
            @focus="$nextTick(() => scrollToBottom())"
            @keydown.enter="if (event.shiftKey) return; event.preventDefault(); $refs.submitButton.click();"
            oninput="this.style.height = ''; this.style.height = Math.min(this.scrollHeight, parseInt(getComputedStyle(this).lineHeight) * 6) + 'px';">
        </textarea>
        <button x-ref="submitButton" class="btn send-button ms-2 text-primary" type="submit">
            <i class="fa-solid fa-paper-plane"></i>
        </button>
    </div>
</form>


            </div>


        </div>
    @else
        <p class="text-center text-muted flex-grow-1 d-flex align-items-center justify-content-center"
            style="
        height: 80vh;
    ">
            {{ __('general.choose_chat') }}
        </p>
    @endif
</div>
