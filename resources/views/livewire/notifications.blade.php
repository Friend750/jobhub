<div class="container mt-4 col-8" x-data x-init="
     console.log('Echo initialized');
let channel = Echo.private('users.{{ auth()->user()->id }}');
channel.notification((notification) => {
if (notification.type === 'App\\Notifications\\Request') {
    $wire.dispatch('messageReceived');
} 
});
">
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
                                        <span class="float-right d-flex flex-column">
                                            {{ \Carbon\Carbon::parse($notification['read_at'])->format('H:i') ??
                                            'Unknown time' }}
                                            <div class="dropdown">
                                                <i class="fa-solid fa-ellipsis" id="dropdownMenuButton"
                                                    data-bs-toggle="dropdown" aria-expanded="false"
                                                    style="cursor: pointer;"></i>
                                                <ul class="dropdown-menu dropdown-menu-end"
                                                    aria-labelledby="dropdownMenuButton">
                                                    <li>
                                                        <button class="dropdown-item"
                                                            wire:click="markAsRead('{{ $notification['id'] }}')">
                                                            Mark as read
                                                        </button>
                                                    </li>
                                                    <li><a class="dropdown-item" href="#">Archive</a></li>
                                                    <li><a class="dropdown-item" href="#">Turn off notifications</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </span>
                                    </div>
                                    @endforeach
                                </div>
                                <div class="tab-pane fade text-center" id="Unread" role="tabpanel"
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
                                        <span class="float-right d-flex flex-column">
                                            {{ \Carbon\Carbon::parse($notification['read_at'])->format('H:i') ??
                                            'Unknown time' }}
                                            <div class="dropdown">
                                                <i class="fa-solid fa-ellipsis" id="dropdownMenuButton"
                                                    data-bs-toggle="dropdown" aria-expanded="false"
                                                    style="cursor: pointer;"></i>
                                                <ul class="dropdown-menu dropdown-menu-end"
                                                    aria-labelledby="dropdownMenuButton">
                                                    <li>
                                                        <button class="dropdown-item"
                                                            wire:click="markAsRead('{{ $notification['id'] }}')">
                                                            Mark as read
                                                        </button>
                                                    </li>
                                                    <li><a class="dropdown-item" href="#">Archive</a></li>
                                                    <li><a class="dropdown-item" href="#">Turn off notifications</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </span>
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