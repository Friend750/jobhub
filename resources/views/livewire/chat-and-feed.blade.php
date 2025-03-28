<div class="">
    {{-- chat card --}}
    <div>
        <div class="card bg-white rounded border shadow-sm flex-grow-1">
            <!-- Header -->
            <h5 class="card-header pt-3 pl-3">Chats</h5>

            <!-- Chat List -->
            <div class="card-body">
                <div>
                    <!-- تحديث كل 5 ثوانٍ -->
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
                    <div class="text-center text-muted mt-3">
                        <p>لا توجد محادثات متوفرة.</p>
                        <a href="/Followers" class="btn btn-primary">ابدأ محادثة جديدة</a>
                    </div>
                    @endforelse
                </div>
            </div>


        </div>
    </div>


    {{-- feed card --}}
    <div class=" card bg-white rounded border shadow-sm mt-3">
        <!-- Header -->
        <h5 class="card-header pt-3">Add to feed</h5>

        <!-- Feed List -->
        <div class="card-body">
            @forelse($suggestions as $suggestion)

            <div class="d-flex align-items-start mb-3 cursor-pointer" x-data
            @click="fetch(`/users/{{ $suggestion['id'] }}/ping`, { method: 'GET' })"
            wire:click='showUser({{  $suggestion['id'] }})'>
                <!-- صورة المستخدم -->
                <img src="https://ui-avatars.com/api/?name={{ urlencode($suggestion['user_name']) }}" alt="User Image"
                    class="rounded-circle ms-2 mt-1 sm-img">
                <div class="d-flex flex-column">
                    <div class="flex-grow-1">
                        <!-- اسم المستخدم -->
                        <a href="#" class="text-dark font-weight-bold text-decoration-none">
                            <strong>{{ $suggestion['user_name'] }}</strong>
                        </a>
                        <!-- الـ professional_summary -->
                        <p class="text-muted small mb-0 truncate-text">
                            {{ $suggestion->personal_details['professional_summary'] ?? 'No professional summary
                            available.' }}
                        </p>
                    </div>
                    @php
                    // Check follow status
                    $connection = DB::table('connections')
                    ->where('follower_id', $suggestion['id'])
                    ->where('following_id', auth()->id())
                    ->first();

                    // Determine states
                    $isFollowing = $connection && $connection->is_accepted == 1; // Active follow
                    $isRequested = $connection && $connection->is_accepted == 0; // Pending request
                    @endphp

                    <button class="btn w-100
    {{ $isFollowing ? 'btn-outline-danger' : ($isRequested ? 'btn-outline-warning' : 'btn-outline-primary') }}
    btn-sm" wire:click="{{ !$isRequested ? ($isFollowing ? 'unFollow(' . $suggestion['id'] . ')' : 'follow(' . $suggestion['id'] . ')') : '' }}">
                        {{ $isFollowing ? __('general.unfollow') : ($isRequested ? __('general.requested') :
                        __('general.follow')) }}
                    </button>
                </div>
            </div>
            @empty
            <!-- رسالة في حالة عدم وجود اقتراحات -->
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
        .cursor-pointer
        {
            cursor: pointer;
        }
    </style>

</div>
</div>
<script>
    document.querySelectorAll(".truncate-text").forEach(element => {
        let text = element.textContent;
        element.textContent = text.length > 30 ? text.substring(0, 30) + "..." : text;
    });
</script>
