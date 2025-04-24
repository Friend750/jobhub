<div class="col-md-3 border-start chat-list d-flex flex-column" id="chat-list"
    :class="isMobile && selectedChat ? 'd-none' : ''">
    <h4 class="mb-3 mt-3 px-3">{{ __('general.chats') }}</h4>

    {{-- If no chats exist, show the button right below the header --}}
    @if (count($chats) === 0)
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
            <li class="d-flex align-items-center p-2 border-bottom"
                @click="
           $wire.selectChat({{ $chat['id'] }});
           selectedChat = true;
           $nextTick(() => scrollToBottom());"
                style="cursor: pointer;">


                <div class="ms-2" style="width:50px; height:50px">
                    <img src="{{ $chat['profile'] }}" class="rounded-circle h-100 object-fit-cover">
                </div>



                <div class="w-100">
                    <strong>{{ $chat['name'] }}</strong>
                    <small class="text-muted d-block m-0 text-truncate"
                        style="max-width: 12ch; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                        {{ $chat['last_message'] ?? $chat['specialist'] }}
                    </small>
                </div>
            </li>
        @endforeach
    </ul>

    {{-- If chats exist, show the button at the bottom --}}
    @if (count($chats) > 0)
        <div class="p-3 border-top">
            <a href="/Followers">
                <button class="btn btn-primary w-100 rounded">
                    {{ __('general.start_new_chat') }}
                </button>
            </a>
        </div>
    @endif
</div>
