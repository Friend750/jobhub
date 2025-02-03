@push('styles')
<link rel="stylesheet" href="{{ asset('css/notifications.css') }}">
<link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
<link rel="stylesheet" href="{{ asset('css/search.css') }}">
@endpush

<div class="container col-8" x-data x-init="
    console.log('Echo initialized');
    let channel = Echo.private('users.{{ auth()->user()->id }}');
    channel.notification((notification) => {
        if (notification.type === 'App\\Notifications\\Request') {
            console.log('Request');
            $wire.dispatch('loadNotifications');
        } 
    });
"
 style="margin-top: 5rem !important;">
    <div class="row">
        <!-- Statistics Section -->
        <div class="col-md-3 mt-3">
            <div class="card">
                <div class="card-header">
                    {{ __('general.notifications') }}
                </div>
                <div class="card-body text-center">
                    <h1>367</h1>
                    <p>{{ __('general.last_post_views') }}</p>
                    <h1>15</h1>
                    <p>{{ __('general.posts_views') }}</p>
                    <h1>9</h1>
                    <p>{{ __('general.profile_views') }}</p>
                </div>
            </div>
        </div>

        <!-- Notifications Section -->
        <div class="col-md-9 mt-3">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <span>{{ __('general.notifications') }}</span>
                    <a href="#" class="text-primary">{{ __('general.mark_all_as_read') }}</a>
                </div>
                <div class="card mb-3">
                    <div class="card-body">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active text-dark" id="tab1-tab" data-toggle="tab" href="#All"
                                    role="tab" aria-controls="tab1" aria-selected="true">
                                    {{ __('general.all') }}
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link text-dark" id="tab2-tab" data-toggle="tab" href="#Mentions"
                                    role="tab" aria-controls="Mentions" aria-selected="false">
                                    {{ __('general.mentions') }}
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link text-dark" id="tab3-tab" data-toggle="tab" href="#Unread" role="tab"
                                    aria-controls="Unread" aria-selected="false">
                                    {{ __('general.unread') }}
                                </a>
                            </li>
                        </ul>
                        <div>
                            <div class="tab-content mt-3" id="myTabContent">
                                <div class="tab-pane fade show active" id="All" role="tabpanel">
                                    @foreach ($notifications as $notification)
                                    <div class="alert {{ $notification['read_at'] ? 'alert-light' : 'alert-primary' }} d-flex justify-content-between align-items-center">
                                        <div>
                                            <strong>
                                                {{ $notification['user_name'] ?? __('general.unknown_sender') }}
                                            </strong>
                                            @if ($notification['type'] === 'App\\Notifications\\Request')
                                            {{ __('general.wants_to_follow') }}
                                            <div>
                                                <button class="btn btn-sm blue mt-2"
                                                    wire:click="acceptRequest({{ $notification['data']['user_id'] }}, {{ auth()->id() }}, '{{ $notification['id'] }}')">
                                                    {{ __('general.accept') }}
                                                </button>
                                                <button class="btn btn-outline-primary btn-sm mt-2"
                                                    wire:click="declineRequest({{ $notification['data']['user_id'] }}, {{ auth()->id() }}, '{{ $notification['id'] }}')">
                                                    {{ __('general.decline') }}
                                                </button>
                                            </div>
                                            @else
                                            {{ __('general.added_comment') }} "{{ $notification['data']['message'] ?? __('general.no_message') }}"
                                            @endif
                                        </div>
                                        <div class="d-flex flex-column align-items-center">
                                            <span class="text-muted small text-center mb-2">
                                                {{ $notification['read_at'] ?? __('general.unknown_time') }}
                                            </span>
                                            @if (is_null($notification['read_at']))
                                            <button class="btn btn-sm btn-outline-primary d-flex align-items-center gap-2"
                                                wire:click="markAsRead('{{ $notification['id'] }}')">
                                                <i class="bi bi-check-circle"></i> {{ __('general.mark_as_read') }}
                                            </button>
                                            @endif
                                        </div>                             
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
