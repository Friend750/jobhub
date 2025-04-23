@push('styles')
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/notifications.css') }}">
    <link rel="stylesheet" href="{{ asset('css/search.css') }}">
@endpush

<div class="container col-8" x-data x-init="console.log('Echo initialized');
let channel = Echo.private('users.{{ auth()->user()->id }}');
channel.notification((notification) => {
    if (notification.type === 'App\\Notifications\\Request') {
        console.log('Request');
        $wire.dispatch('loadNotifications');
    } else if (notification.type === 'App\\Notifications\\Comment') {
        console.log('Comment');
        $wire.dispatch('loadNotifications');
    } else if (notification.type === 'App\\Notifications\\Like') {
        console.log('Like');
        $wire.dispatch('loadNotifications');
    }
});" style="margin-top: 5rem !important;">
    <div class="row">
        <!-- Statistics Section -->
        <div class="col-md-3 mt-3">
            <div class="card">
                <div class="card-body text-center">
                    <h1>{{ $statistics['lastPostViews']->views ?? 0 }}</h1>
                    <p>{{ __('general.last_post_views') }}</p>

                    <h1>{{ $statistics['postViews'] }}</h1>
                    <p>{{ __('general.posts_views') }}</p>

                    <h1>{{ $statistics['profileViews'] }}</h1>
                    <p>{{ __('general.profile_views') }}</p>
                </div>

            </div>
        </div>

        <!-- Notifications Section -->
        <div class="col-md-9 mt-3 "style="
        height: 70vh;
    ">
            <div class="card h-100">
                <div class="card-body d-flex justify-content-between" style="flex:none;">
                    <span>{{ __('general.notifications') }}</span>
                    <a wire:click.prevent="markAllAsRead()" href="#"
                        class="text-primary">{{ __('general.mark_all_as_read') }}</a>
                </div>
                <div class=" mb-3">
                    <div class="card-body">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active text-dark" id="All-tab" data-bs-toggle="tab" href="#All"
                                    role="tab" aria-controls="All" aria-selected="true">
                                    {{ __('general.all') }}
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link text-dark" id="Mentions-tab" data-bs-toggle="tab" href="#Mentions"
                                    role="tab" aria-controls="Mentions" aria-selected="false">
                                    {{ __('general.mentions') }}
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link text-dark" id="Unread-tab" data-bs-toggle="tab" href="#Unread"
                                    role="tab" aria-controls="Unread" aria-selected="false">
                                    {{ __('general.unread') }}
                                </a>
                            </li>
                        </ul>
                        <div>
                            <div class="tab-content mt-3" id="myTabContent">
                                <div class="tab-pane fade show active" id="All" role="tabpanel">
                                    @forelse ($notifications as $notification)
                                        <div
                                            class="alert {{ $notification['read_at'] ? 'alert-light' : 'alert-primary' }} d-flex justify-content-between align-items-center">
                                            <div>
                                                <strong>
                                                    {{ ($notification['data']['personalDetails']['first_name'] ?? '') . ' ' . ($notification['data']['personalDetails']['last_name'] ?? '') }}
                                                </strong>
                                                @if ($notification['type'] === 'App\\Notifications\\Request')
                                                    {{ __('general.wants_to_follow') }}
                                                    <div>
                                                        <button class="btn btn-sm blue mt-2 resize-btn rounded"
                                                            wire:click="acceptRequest({{ $notification['data']['user_id'] }}, {{ auth()->id() }}, '{{ $notification['id'] }}')">
                                                            {{ __('general.accept') }}
                                                        </button>
                                                        <button
                                                            class="btn btn-outline-primary btn-sm mt-2 resize-btn rounded"
                                                            wire:click="declineRequest({{ $notification['data']['user_id'] }}, {{ auth()->id() }}, '{{ $notification['id'] }}')">
                                                            {{ __('general.decline') }}
                                                        </button>
                                                    </div>
                                                @endif
                                                @if ($notification['type'] === 'App\\Notifications\\Like')
                                                    {{ __('general.added_like') }}
                                                @endif
                                                @if ($notification['type'] === 'App\\Notifications\\Comment')
                                                    {{ __('general.added_comment') }}
                                                    "{{ $notification['data']['comment'] ?? __('general.no_message') }}"
                                                @endif



                                            </div>
                                            <div class="d-flex flex-column align-items-center">
                                                @if (isset($notification['data']['post_type']) && $notification['data']['post_type'] === 'Post')
                                                    @php
                                                        $post = $notification['data']['post'] ?? null;
                                                    @endphp

                                                    @if (!empty($post['post_image']))
                                                        <img src="{{ asset('storage/' . $post['post_image']) }}"
                                                            alt="Image" class="img-fluid mt-2"
                                                            style="max-width: 100px;">
                                                        <span>
                                                            {{ strlen($post['content'] ?? '') > 15 ? substr($post['content'], 0, 15) . '...' : $post['content'] ?? '' }}
                                                        </span>
                                                    @elseif (!empty($post['content']))
                                                        <span>
                                                            {{ strlen($post['content']) > 15 ? substr($post['content'], 0, 15) . '...' : $post['content'] }}
                                                        </span>
                                                    @else
                                                        <span>No content available.</span>
                                                    @endif
                                                @elseif (isset($notification['data']['post']['job_title']))
                                                    <span>{{ $notification['data']['post']['job_title'] }}</span>
                                                @else
                                                @endif


                                                <span class="text-muted small text-center mb-2">
                                                    {{ $notification['read_at'] ?? __('general.unknown_time') }}
                                                </span>

                                                @if (is_null($notification['read_at']))
                                                    <button
                                                        class="btn btn-sm btn-outline-primary d-flex align-items-center gap-2 rounded"
                                                        wire:click="markAsRead('{{ $notification['id'] }}')">
                                                        <i class="bi bi-check-circle"></i>
                                                        {{ __('general.mark_as_read') }}
                                                    </button>
                                                @endif
                                            </div>
                                        </div>
                                    @empty
                                        <h6 class="text-center mt-4 text-muted">
                                            لا يوجد اي اشعارات حاليا
                                        </h6>
                                    @endforelse
                                </div>
                                <div class="tab-pane fade bg-white" id="Mentions" role="tabpanel">
                                    @forelse ($notifications as $notification)
                                        @if ($notification['type'] === 'App\Notifications\Comment' || $notification['type'] === 'App\Notifications\Like')
                                            <div
                                                class="alert {{ $notification['read_at'] ? 'alert-light' : 'alert-primary' }} d-flex justify-content-between align-items-center">
                                                <div>
                                                    <strong>
                                                        {{ ($notification['data']['personalDetails']['first_name'] ?? '') . ' ' . ($notification['data']['personalDetails']['last_name'] ?? '') }}
                                                    </strong>
                                                    @if ($notification['type'] === 'App\\Notifications\\Like')
                                                        {{ __('general.added_like') }}
                                                    @endif
                                                    @if ($notification['type'] === 'App\\Notifications\\Comment')
                                                        {{ __('general.added_comment') }}
                                                        "{{ $notification['data']['comment'] ?? __('general.no_message') }}"
                                                    @endif
                                                </div>
                                                <div class="d-flex flex-column align-items-center">
                                                    <div class="d-flex flex-column align-items-center">
                                                        @if (isset($notification['data']['post_type']) && $notification['data']['post_type'] === 'Post')
                                                            @php
                                                                $post = $notification['data']['post'] ?? null;
                                                            @endphp

                                                            @if (!empty($post['post_image']))
                                                                <img src="{{ asset('storage/' . $post['post_image']) }}"
                                                                    alt="Image" class="img-fluid mt-2"
                                                                    style="max-width: 100px;">
                                                                <span>
                                                                    {{ strlen($post['content'] ?? '') > 15 ? substr($post['content'], 0, 15) . '...' : $post['content'] ?? '' }}
                                                                </span>
                                                            @elseif (!empty($post['content']))
                                                                <span>
                                                                    {{ strlen($post['content']) > 15 ? substr($post['content'], 0, 15) . '...' : $post['content'] }}
                                                                </span>
                                                            @else
                                                                <span>No content available.</span>
                                                            @endif
                                                        @elseif (isset($notification['data']['post']['job_title']))
                                                            <span>{{ $notification['data']['post']['job_title'] }}</span>
                                                        @else
                                                        @endif


                                                        <span class="text-muted small text-center mb-2">
                                                            {{ $notification['read_at'] ?? __('general.unknown_time') }}
                                                        </span>
                                                        @if (is_null($notification['read_at']))
                                                            <button
                                                                class="btn btn-sm btn-outline-primary d-flex align-items-center gap-2 rounded"
                                                                wire:click="markAsRead('{{ $notification['id'] }}')">
                                                                <i class="bi bi-check-circle"></i>
                                                                {{ __('general.mark_as_read') }}
                                                            </button>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @empty
                                    <h6 class="text-center mt-4 text-muted">
                                        لا يوجد اي تفاعلات حاليا
                                    </h6>
                                    @endforelse
                                </div>
                                <div class="tab-pane fade" id="Unread" role="tabpanel">
                                    @forelse ($notifications as $notification)
                                        @if (is_null($notification['read_at']))
                                            <div
                                                class="alert alert-primary d-flex justify-content-between align-items-center">
                                                <div>
                                                    <strong>
                                                        {{ ($notification['data']['personalDetails']['first_name'] ?? '') . ' ' . ($notification['data']['personalDetails']['last_name'] ?? '') }}
                                                    </strong>

                                                    @if ($notification['type'] === 'App\\Notifications\\Request')
                                                        {{ __('general.wants_to_follow') }}
                                                        <div>
                                                            <button class="btn btn-sm blue mt-2 rounded resize-btn"
                                                                wire:click="acceptRequest({{ $notification['data']['user_id'] }}, {{ auth()->id() }}, '{{ $notification['id'] }}')">
                                                                {{ __('general.accept') }}
                                                            </button>
                                                            <button
                                                                class="btn btn-outline-primary btn-sm mt-2 rounded resize-btn"
                                                                wire:click="declineRequest({{ $notification['data']['user_id'] }}, {{ auth()->id() }}, '{{ $notification['id'] }}')">
                                                                {{ __('general.decline') }}
                                                            </button>
                                                        </div>
                                                    @else
                                                        {{ __('general.added_comment') }}"{{ $notification['data']['comment'] ?? __('general.no_message') }}"
                                                    @endif
                                                </div>
                                                <div class="d-flex flex-column align-items-center">
                                                    <span class="text-muted small text-center mb-2">
                                                        {{ $notification['created_at'] ?? __('general.unknown_time') }}
                                                    </span>
                                                    <button
                                                        class="btn btn-sm btn-outline-primary d-flex align-items-center gap-2"
                                                        wire:click="markAsRead('{{ $notification['id'] }}')">
                                                        <i class="bi bi-check-circle"></i>
                                                        {{ __('general.mark_as_read') }}
                                                    </button>
                                                </div>
                                            </div>
                                        @endif
                                    @empty
                                        <h6 class="text-center mt-4 text-muted">
                                            لا يوجد اي اشعارات غير مقروءة حاليا
                                        </h6>
                                    @endforelse
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
