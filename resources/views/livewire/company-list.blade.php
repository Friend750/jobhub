<div class="container" style="margin-top: 5.5rem !important;">
    <div class="row">
        <!-- قسم إدارة الشبكة -->
        @livewire('manage-network')
        <!-- قسم قائمة الشركات -->
        <div class="col-md-8 containerOfNetwork">
            <div class="mb-3 d-flex justify-content-between align-items-center">
                <h4 class="mt-3">{{ __('general.companies') }}</h4>
            </div>
            @forelse ($companies as $company)
            @php
                // Read status from backend once
                $status = $this->getFollowStatus($company['id']);
                $isFollowing = $status['isFollowing'];
                $isRequested = $status['isRequested'];
            @endphp

            <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                <div style="cursor: pointer" class="d-flex align-items-center"
                     @click="fetch(`/users/{{ $company['id'] }}/ping`, { method: 'GET' })"
                     wire:click='showUser({{ $company['id'] }})'>
                    <!-- Default avatar image -->
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($company['name']) }}"
                         alt="Logo" class="rounded-circle ms-2" width="40">
                    <div class="ms-3">
                        <strong>{{ $company['name'] }}</strong>
                        <div class="text-muted">{{ $company['position'] ?? __('general.position') }}</div>
                    </div>
                </div>

                <!-- Alpine component for optimistic UI update -->
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
                                        isFollowing = false;
                                        $wire.unFollow({{ $company['id'] }});
                                    } else {
                                        isRequested = true;
                                        $wire.follow({{ $company['id'] }});
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
                        {{ __('general.no_followed_companies') }}
                    </button>
                </a>
            </div>
            @endforelse


        </div>
    </div>
</div>
