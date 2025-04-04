<div class="">
    {{-- Chat Card --}}
    <div>
        <div class="card bg-white rounded border shadow-sm flex-grow-1">
            <!-- Header -->
            <h5 class="card-header pt-3 pl-3">Chats</h5>

            <!-- Chat List -->
            <div class="card-body">
                <div>
                    {{-- Chat list refreshes every 5 seconds --}}
                    @forelse ($chats as $chat)
                        <a href="/chat/{{ $chat['id'] }}" class="text-decoration-none text-dark">
                            <div class="d-flex align-items-center clickable-div py-1 justify-content-start">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($chat['profile']) }}" alt="User"
                                    class="rounded-circle ms-2 sm-img">
                                <div>
                                    <strong>{{ $chat['name'] }}</strong>
                                    <p class="text-muted small mb-0 truncate-text">{{ $chat['last_message'] }}</p>
                                </div>
                            </div>
                        </a>
                    @empty
                        <div class="text-center text-muted my-3">
                            <p class="mb-0">لا توجد محادثات متوفرة.</p>
                            <a href="/Followers" class="text-decoration-none">ابدأ محادثة جديدة</a>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    {{-- Feed Card --}}
    <div class="card bg-white rounded border shadow-sm mt-3">
        <!-- Header -->
        <h5 class="card-header pt-3">Add to feed</h5>

        <!-- Feed List -->
        <div class="card-body">
            @forelse($suggestions as $suggestion)
                        <div class="d-flex align-items-start mb-3 cursor-pointer" x-data
                            @click="fetch(`/users/{{ $suggestion['id'] }}/ping`, { method: 'GET' })"
                            wire:click='showUser({{ $suggestion['id'] }})'>
                            <!-- User Image -->
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($suggestion['user_name']) }}" alt="User Image"
                                class="rounded-circle ms-2 mt-1 sm-img">
                            <div class="d-flex flex-column">
                                <div class="flex-grow-1">
                                    <!-- User Name -->
                                    <a href="#" class="text-dark font-weight-bold text-decoration-none">
                                        <strong>{{ $suggestion['user_name'] }}</strong>
                                    </a>
                                    <!-- Professional Summary -->
                                    <p class="text-muted small mb-0 truncate-text">
                                        {{ $suggestion->personal_details['professional_summary'] ?? 'No professional summary available.' }}
                                    </p>
                                </div>
                                @php
                                    // Fetch follow status from the backend once using your helper method
                                    $status = $this->getFollowStatus($suggestion['id']);
                                    $isFollowing = $status['isFollowing'];
                                    $isRequested = $status['isRequested'];
                                @endphp
                                <!-- Alpine.js container for optimistic update -->
                                <div class="mt-2" wire:ignore
                                    x-data="{ isFollowing: @json($isFollowing), isRequested: @json($isRequested) }">
                                    <button class="btn w-100 btn-sm" :class="isFollowing ? 'btn-outline-danger' : (isRequested ? 'btn-outline-warning' : 'btn-outline-primary')" @click.prevent="
                                                                if (!isRequested) {
                                                                    if (isFollowing) {
                                                                        // Optimistically update UI for unfollow
                                                                        isFollowing = false;
                                                                        $wire.unFollow({{ $suggestion['id'] }});
                                                                    } else {
                                                                        // Optimistically update UI for follow (set state to 'requested')
                                                                        isRequested = true;
                                                                        $wire.follow({{ $suggestion['id'] }});
                                                                    }
                                                                }
                                                            ">
                                        <span
                                            x-text="isFollowing ? '{{ __('general.unfollow') }}' : (isRequested ? '{{ __('general.requested') }}' : '{{ __('general.follow') }}')"></span>
                                    </button>
                                </div>
                            </div>
                        </div>
            @empty
                <!-- Message when no suggestions available -->
                <div class="text-center text-muted py-3">
                    لا يوجد مستخدمين بنفس الاهتمامات.
                </div>
            @endforelse
        </div>
    </div>

    <style>
        .truncate-text {
            font-size: .75rem;
        }

        .cursor-pointer {
            cursor: pointer;
        }
    </style>
</div>

<script>
    document.querySelectorAll(".truncate-text").forEach(element => {
        let text = element.textContent;
        element.textContent = text.length > 30 ? text.substring(0, 30) + "..." : text;
    });
</script>
