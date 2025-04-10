<div class="container" style="margin-top: 5.5rem !important;">
    <div class="row">
        <!-- Manage Network Section -->
        @livewire('manage-network')

        <!-- Followings List Section -->
        <div class="col-md-8 containerOfNetwork">
            <div class="mb-3 d-flex justify-content-between align-items-center">
                <h4 class="mt-3 border-b-2">{{ __('general.following') }}</h4>
            </div>
            @forelse ($followings as $following)
                @php
                    // Read status from backend once
                    $status = $this->getFollowStatus($following['id']);
                    $isFollowing = $status['isFollowing'];
                    $isRequested = $status['isRequested'];
                @endphp
                <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                    <div style="cursor: pointer" class="d-flex align-items-center" x-data
                         @click="fetch(`/users/{{ $following['id'] }}/ping`, { method: 'GET' })"
                         wire:click='showUser({{ $following['id'] }})'>
                        <!-- Default image -->
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($following['name']) }}"
                             alt="Logo" class="rounded-circle ms-2" width="40">
                        <div class="ms-3">
                            <strong>{{ $following['name'] }}</strong>
                            <div class="text-muted">{{ $following['position'] ?? __('general.position') }}</div>
                        </div>
                    </div>

                    <!-- Alpine component for optimistic UI update with wire:ignore -->
                    <div class="d-flex align-items-center" wire:ignore
                         x-data="{
                             isFollowing: @json($isFollowing),
                             isRequested: @json($isRequested)
                         }">
                        <button class="btn btn-sm"
                                :class="isFollowing ? 'btn-outline-danger' : (isRequested ? 'btn-outline-warning' : 'btn-outline-primary')"
                                @click.prevent="
                                    if (!isRequested) {
                                        if (isFollowing) {
                                            // Optimistically update UI for unfollow
                                            isFollowing = false;
                                            $wire.unFollow({{ $following['id'] }});
                                        } else {
                                            // Optimistically update UI for follow (show 'requested')
                                            isRequested = true;
                                            $wire.follow({{ $following['id'] }});
                                        }
                                    }
                                ">
                            <span x-text="isFollowing ? '{{ __('general.unfollow') }}' : (isRequested ? '{{ __('general.requested') }}' : '{{ __('general.follow') }}')"></span>
                        </button>
                    </div>
                </div>
            @empty
                <div class="d-flex justify-content-center align-items-center py-4">
                    <a href="/Search">
                        <button class="btn btn-primary">
                            {{ __('general.search_for_followings') }}
                        </button>
                    </a>
                </div>
            @endforelse
        </div>
    </div>
</div>
