<div class="container" style="margin-top: 5.5rem !important;">
    <div class="row">
        <!-- قسم إدارة الشبكة -->
        @livewire('manage-network')
        <!-- قسم قائمة الشركات -->
        <div class="col-md-8 containerOfNetwork">
            <div class="mb-3 d-flex justify-content-between align-items-center">
                <h4 class="mt-3">{{ __('general.companies') }}</h4>
            </div>
            @forelse($companies as $company)
            <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                <div style="cursor: pointer" class="d-flex align-items-center"
                @click="fetch(`/users/{{ $company['id'] }}/ping`, { method: 'GET' })"
                wire:click='showUser({{  $company['id'] }})'>
                    <!-- Default avatar image -->
                    <img src="https://ui-avatars.com/api/?name=Image" alt="Logo" class="rounded-circle ms-2" width="40">
                    <div class="ms-3">
                        <strong>{{ $company['user_name'] }}</strong>
                        <div class="text-muted">{{ $company['position'] ?? __('general.position') }}</div>
                    </div>
                </div>
                @php
                // Check follow status
                $connection = DB::table('connections')
                ->where('follower_id', $company['id'])
                ->where('following_id', auth()->id())
                ->first();

                // Determine states
                $isFollowing = $connection && $connection->is_accepted == 1; // Active follow
                $isRequested = $connection && $connection->is_accepted == 0; // Pending request
                @endphp

                <button class="btn
                    {{ $isFollowing ? 'btn-outline-danger' : ($isRequested ? 'btn-outline-warning' : 'btn-outline-primary') }}
                    btn-sm"
                    wire:click="{{ !$isRequested ? ($isFollowing ? 'unFollow(' . $company['id'] . ')' : 'follow(' . $company['id'] . ')') : '' }}">
                    {{ $isFollowing ? __('general.unfollow') : ($isRequested ? __('general.requested') :
                    __('general.follow')) }}
                </button>
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
