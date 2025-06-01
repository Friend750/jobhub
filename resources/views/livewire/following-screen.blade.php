<div class="container" style="margin-top: 5.5rem !important;">
    <div class="row">

        <div class="col-lg-3 p-0 d-flex justify-content-end">
            <div class="MakeSticky w-75" style="
            height: fit-content;">
                @livewire('manage-network')
            </div>
        </div>


        <!-- Followings List Section -->
        <div class="col-md-6">
            <div class="card rounded border" style="
            min-height: 80vh;
        ">
                <div class="p-3 card-img-top text-center text-muted">
                    <h4 class="">{{ __('general.following') }}</h4>
                </div>

                @forelse ($followings as $following)
                    @php
                        // Read status from backend once
                        $status = $this->getFollowStatus($following['id']);
                        $isFollowing = $status['isFollowing'];
                        $isRequested = $status['isRequested'];
                    @endphp

                    <div class="d-flex justify-content-between align-items-center p-3 withHover">
                        <div style="cursor: pointer" class="d-flex align-items-center" x-data
                            @click="fetch(`/users/{{ $following['id'] }}/ping`, { method: 'GET' })"
                            wire:click='showUser({{ $following['id'] }})'>
                            <!-- Default image -->
                            <img src="{{ $following['user_image'] }}" alt="Logo" class="rounded-circle ms-2"
                                style="
                                object-fit: cover;
                                width: 50px;
                                height: 50px;">
                            <div class="ms-3">
                                <strong>{{ $following['name'] }}</strong>
                                <div class="text-muted">{{ $following['position'] ?? __('general.position') }}</div>
                            </div>
                        </div>

                        <!-- Alpine component for optimistic UI update with wire:ignore -->
                        <div class="d-flex align-items-center" wire:ignore x-data="{
                            isFollowing: @json($isFollowing),
                            isRequested: @json($isRequested)
                        }">
                            <button class="btn btn-sm fw-bold"
                                :class="isFollowing ? 'btn-secondary' : (isRequested ? 'btn-secondary' :
                                    'btn-primary')"
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
                                <span
                                    x-text="isFollowing ? '{{ __('general.unfollow') }}' : (isRequested ? '{{ __('general.requested') }}' : '{{ __('general.follow') }}')"></span>
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

        <div class="col-lg-3 p-0">
            <div class="MakeSticky w-75">
                @livewire('ChatAndFeed')
            </div>
        </div>

    </div>
</div>
