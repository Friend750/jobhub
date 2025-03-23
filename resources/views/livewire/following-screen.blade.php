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
            <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                <div style="cursor: pointer" class="d-flex align-items-center" wire:click='showUser({{  $following['id'] }})'>
                    <!-- صورة افتراضية -->
                    <img src="https://ui-avatars.com/api/?name=Image" alt="Logo" class="rounded-circle ms-2" width="40">
                    <div class="ms-3">
                        <strong>{{ $following['user_name'] }}</strong>
                        <div class="text-muted">{{ $following['position'] ?? __('general.position') }}</div>
                    </div>
                </div>

                @php
                // التحقق من حالة المتابعة
                $connection = DB::table('connections')
                ->where('follower_id', $following['id'])
                ->where('following_id', auth()->id())
                ->first();

                $isFollowing = $connection && $connection->is_accepted == 1; // متابع نشط
                $isRequested = $connection && $connection->is_accepted == 0; // طلب قيد الانتظار
                @endphp

                <button class="btn
                        {{ $isFollowing ? 'btn-outline-danger' : ($isRequested ? 'btn-outline-warning' : 'btn-outline-primary') }}
                        btn-sm"
                    wire:click="{{ !$isRequested ? ($isFollowing ? 'unFollow(' . $following['id'] . ')' : 'follow(' . $following['id'] . ')') : '' }}">
                    {{ $isFollowing ? __('general.unfollow') : ($isRequested ? __('general.requested') :
                    __('general.follow')) }}
                </button>
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
