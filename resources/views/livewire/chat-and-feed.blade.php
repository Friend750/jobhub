<div class="">
    {{-- Chat Card --}}
    <div>
        <div class="card bg-white rounded border shadow-sm flex-grow-1">
            <!-- Header -->
            <h5 class="m-0 p-3">{{ __('general.chats') }}</h5>

            <!-- Chat List -->
            <div class="card-body pt-0">
                <div>
                    {{-- Chat list refreshes every 5 seconds --}}
                    @forelse ($chats as $chat)
                        <a href="/chat/{{ $chat['id'] }}" class="text-decoration-none text-dark">
                            <div class="d-flex align-items-center clickable-div py-1 justify-content-start">
                                <img src="{{ $chat['profile'] }}" alt="User" class="rounded-circle ms-2 mt-1 sm-img"
                                    style="height: 40px;">
                                <div>
                                    <strong>{{ $chat['full_name'] }}</strong>
                                    <p class="text-muted small mb-0 truncate-text"   style="max-width: 20ch; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $chat['last_message'] }}</p>
                                </div>
                            </div>
                        </a>
                    @empty
                        <div class="text-center text-muted my-3">
                            <a href="/Followers" class="text-decoration-none">
                                {{ __('general.start_new_chat') }}
                            </a>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    {{-- Feed Card --}}
    <div class="card bg-white rounded border shadow-sm mt-3">
        <!-- Header -->
        <h5 class="m-0 p-3">{{ __('general.addToFollowing') }}</h5>

        <!-- Feed List -->
        <div class="card-body pt-0">
            @forelse($suggestions as $suggestion)
                <div class="d-flex align-items-start py-2 {{ !$loop->last ? 'border-bottom' : '' }}">

                    <!-- User Image -->
                    <img src="{{ $suggestion->user_image_url }}" alt="User Image"
                        class="rounded-circle ms-2 mt-1 sm-img cursor-pointer" x-data
                        @click="fetch(`/users/{{ $suggestion['id'] }}/ping`, { method: 'GET' })"
                        wire:click='showUser({{ $suggestion['id'] }})'>

                    <div class="d-flex flex-column">

                        <div class="flex-grow-1">
                            <!-- User Name -->
                            @if ($suggestion->fullName())
                                <a class="text-dark font-weight-bold text-decoration-none">
                                    <strong>{{ $suggestion->fullName() ?? $suggestion->user_name }}</strong>
                                </a>
                            @else
                                <a class="text-dark font-weight-bold text-decoration-none">
                                    <strong>{{ $suggestion->user_name }}</strong>
                            @endif
                            <!-- Professional Summary -->
                            <p class="text-muted small mb-0 truncate-text">
                                {{ $suggestion->personal_details->specialist ?? 'No specialist' }}
                            </p>
                        </div>

                        @php
                            // Fetch follow status from the backend once using your helper method
                            $status = $this->getFollowStatus($suggestion['id']);
                            $isFollowing = $status['isFollowing'];
                            $isRequested = $status['isRequested'];
                        @endphp
                        <!-- Alpine.js container for optimistic update -->
                        <div class="" wire:ignore x-data="{ isFollowing: @json($isFollowing), isRequested: @json($isRequested) }">
                            <button class="btn w-100 btn-sm badge"
                                :class="isFollowing ? 'btn-outline-primary' : (isRequested ? 'btn-outline-primary' :
                                    'btn-outline-primary')"
                                @click.prevent="
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
                                                                "
                                style="
                                            font-size: xx-small;
                                            width: fit-content !important;
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
