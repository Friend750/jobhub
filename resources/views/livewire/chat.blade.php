@push('styles')
    <link rel="stylesheet" href="{{ asset('css/chat.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/search.css') }}">
@endpush

<div class="container rounded p-3 shadow-sm" style="margin-top: 5.5rem;" x-data="chatApp" @resize.window="isMobile = window.innerWidth <= 768">
    <div class="row col-md-12 justify-content-center m-0 p-0 rounded border" x-data x-init="initEcho()">

        <!-- Side Chat List -->
        @include('livewire.includes.chat.chat-list')
        <!-- Chat Messages -->
        @include('livewire.includes.chat.chat-messages')

    </div>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('chatApp', () => ({
            selectedChat: null,
            isMobile: window.innerWidth <= 768,
            scrollToBottom() {
                const container = this.$refs.messagesContainer;
                if (container) {
                    container.scrollTop = container.scrollHeight;
                }
            }
        }));

        Alpine.data('chatMessages', () => ({
            previousScrollHeight: 0,
            saveScrollPosition() {
                this.previousScrollHeight = this.$refs.messagesContainer.scrollHeight;
            },
            restoreScrollPosition() {
                const container = this.$refs.messagesContainer;
                const newScrollHeight = container.scrollHeight;
                container.scrollTop = newScrollHeight - this.previousScrollHeight;
            },
            handleScroll(container) {
                if (container.scrollTop === 0) {
                    this.saveScrollPosition();
                    this.$wire.loadMessages().then(() => this.restoreScrollPosition());
                }
            },
            scrollToBottom() {
                const container = this.$refs.messagesContainer;
                if (container) {
                    container.scrollTop = container.scrollHeight;
                }
            }
        }));
    });

    function initEcho() {
        let channel = Echo.private('users.{{ auth()->user()->id }}');
        channel.notification((notification) => {
            if (notification.type === 'App\\Notifications\\SentMessage') {
                this.$wire.dispatch('messageReceived');
            }
        });
    }
</script>
