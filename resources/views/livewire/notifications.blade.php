@push('styles')
<link rel="stylesheet" href="{{ asset('css/notifications.css') }}">
<link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
<link rel="stylesheet" href="{{ asset('css/search.css') }}">
@endpush
<div class="container  col-8" x-data x-init="
     console.log('Echo initialized');
let channel = Echo.private('users.{{ auth()->user()->id }}');
channel.notification((notification) => {
if (notification.type === 'App\\Notifications\\Request') {
    console.log('Request');
    $wire.dispatch('loadNotifications');
} 
});
"
 style="margin-top: 5rem !important;"
>
    <div class="row">
        <!-- قسم الإحصائيات -->
        <div class="col-md-3 mt-3">
            <div class="card">
                <div class="card-header">
                    NOTIFICATIONS
                </div>
                <div class="card-body text-center">
                    <h1>367</h1>
                    <p>Last Post Views</p>
                    <h1>15</h1>
                    <p>Posts views</p>
                    <h1>9</h1>
                    <p>Profile views</p>
                </div>
            </div>
        </div>

        <!-- قسم الإشعارات -->
        <div class="col-md-9 mt-3">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <span>Notifications</span>
                    <a href="#" class="text-primary">Mark all as read</a>
                </div>
                <div class="card mb-3">
                    <div class="card-body">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active text-dark" id="tab1-tab" data-toggle="tab" href="#All"
                                    role="tab" aria-controls="tab1" aria-selected="true">
                                    All
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link text-dark" id="tab2-tab" data-toggle="tab" href="#Mentions"
                                    role="tab" aria-controls="Mentions" aria-selected="false">
                                    Mentions
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link text-dark" id="tab3-tab" data-toggle="tab" href="#Unread" role="tab"
                                    aria-controls="Unread" aria-selected="false">
                                    Unread
                                </a>
                            </li>
                        </ul>
                        <div>
                            <div class="tab-content mt-3" id="myTabContent">
                                <div class="tab-pane fade show active" id="All" role="tabpanel">
                                    @foreach ($notifications as $notification)
                                    <div
                
                                        class="alert {{ $notification['read_at'] ? 'alert-light' : 'alert-primary' }} d-flex justify-content-between align-items-center">
                                        <div>
                                            <strong>
                                                {{ $notification['user_name'] ?? 'Unknown Sender' }}
                                            </strong>
                                            @if ($notification['type'] === 'App\\Notifications\\Request')
                                            wants to follow you.
                                            <div>
                                                <button class="btn btn-sm blue mt-2"
                                                    wire:click="acceptRequest({{ $notification['data']['user_id'] }}, {{ auth()->id() }}, '{{ $notification['id'] }}')">Accept</button>
                                                <button class="btn btn-outline-primary btn-sm mt-2"
                                                    wire:click="declineRequest({{ $notification['data']['user_id'] }}, {{ auth()->id() }}, '{{ $notification['id'] }}')">Decline</button>
                                            </div>
                                            @else
                                            added a comment: "{{ $notification['data']['message'] ?? 'No message
                                            provided' }}"
                                            @endif
                                        </div>
                                        <div class="d-flex flex-column align-items-center">
                                            <span class="text-muted small text-center mb-2">
                                                {{ $notification['read_at'] ?? 'Unknown time' }}
                                            </span>
                                            @if (is_null($notification['read_at']))
                                            <button class="btn btn-sm btn-outline-primary d-flex align-items-center gap-2"
                                                wire:click="markAsRead('{{ $notification['id'] }}')">
                                                <i class="bi bi-check-circle"></i> Mark as Read
                                            </button>
                                        @endif
                                        
                                        </div>                             
                                    </div>
                                    @endforeach
                                </div>
                                <div class="tab-pane fade" id="Unread" role="tabpanel"
                                    aria-labelledby="tab3-tab">
                                    @foreach ($notifications->where('read_at', null) as $notification)
                                    <div
                                        class="alert {{ $notification['read_at'] ? 'alert-light' : 'alert-primary' }} d-flex justify-content-between align-items-center">
                                        <div>
                                            <strong>
                                                {{ $notification['user_name'] ?? 'Unknown Sender' }}
                                            </strong>
                                            @if ($notification['type'] === 'App\\Notifications\\Request')
                                            wants to follow you.
                                            <div>
                                                <button class="btn btn-sm blue mt-2"
                                                    wire:click="acceptRequest({{ $notification['data']['user_id'] }}, {{ auth()->id() }}, '{{ $notification['id'] }}')">Accept</button>
                                                <button class="btn btn-outline-primary btn-sm mt-2"
                                                    wire:click="declineRequest({{ $notification['data']['user_id'] }}, {{ auth()->id() }}, '{{ $notification['id'] }}')">Decline</button>
                                            </div>
                                            @else
                                            added a comment: "{{ $notification['data']['message'] ?? 'No message
                                            provided' }}"
                                            @endif
                                        </div>
                                       <div class="d-flex flex-column align-items-center">
                                            <span class="text-muted small text-center mb-2">
                                                {{ $notification['read_at'] ?? 'Unknown time' }}
                                            </span>
                                            <button class="btn btn-sm btn-outline-primary d-flex align-items-center gap-2"
                                                wire:click="markAsRead('{{ $notification['id'] }}')">
                                                <i class="bi bi-check-circle"></i> Mark as Read
                                            </button>
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