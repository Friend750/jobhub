<div class="container" style="margin-top: 5.5rem !important;">
    <div class="row">
        <!-- قسم إدارة الشبكة -->
        @livewire('manage-network')


        <!-- قسم قائمة الشركات -->
        <div class="col-md-8 containerOfNetwork">
            <div class="mb-3 d-flex justify-content-between align-items-center">
                <h4 class="mt-3 border-b-2">Followings</h4>
            </div>
            @foreach ($followings as $following)
                <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                    <div class="d-flex align-items-center">
                        <!-- صورة افتراضية للشركة -->
                        <img src="'https://via.placeholder.com/50/CCCCCC/FFFFFF?text=Logo' }}" alt="Logo"
                            loading="lazy" class="rounded-circle" width="50" height="50">
                        <div class="ms-3">
                            <strong>{{ $following['user_name'] }}</strong>
                            <div class="text-muted">{{ $following['position'] }}</div>
                        </div>
                    </div>
                    @php
                        // التحقق من حالات المتابعة
                        $connection = DB::table('connections')
                            ->where('follower_id', $following['id'])
                            ->where('following_id', auth()->id())
                            ->first();

                        // تحقق من حالات مختلفة
                        $isFollowing = $connection && $connection->is_accepted == 1; // متابعة فعلية
                        $isRequested = $connection && $connection->is_accepted == 0; // طلب قيد الانتظار
                    @endphp

                    <button
                        class="btn
        {{ $isFollowing ? 'btn-outline-danger' : ($isRequested ? 'btn-outline-warning' : 'btn-outline-primary') }}
        btn-sm"
                        wire:click="{{ !$isRequested ? ($isFollowing ? 'unFollow(' . $following['id'] . ')' : 'follow(' . $following['id'] . ')') : '' }}">
                        {{ $isFollowing ? 'UnFollow' : ($isRequested ? 'Requested' : 'Follow') }}
                    </button>

                </div>
            @endforeach
        </div>
    </div>
</div>
