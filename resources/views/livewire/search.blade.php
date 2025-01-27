@push('styles')
<link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
<link rel="stylesheet" href="{{ asset('css/search.css') }}">
@endpush
<div class="container col-md-9" style="margin-top: 5.2rem !important;">
    <div class="row">
        <div class="col-md-3">
            <div class="list-group">
                <!-- People Link -->
                <a href="#" class="list-group-item list-group-item-action {{ $activeTab === 'people' ? 'stick' : '' }}"
                    wire:click.prevent="switchTab('people')">
                    <strong class="mr-2">|</strong>People
                </a>

                <!-- Company Link -->
                <a href="#" class="list-group-item list-group-item-action {{ $activeTab === 'company' ? 'stick' : '' }}"
                    wire:click.prevent="switchTab('company')">
                    <strong class="mr-2">|</strong>Company
                </a>
            </div>

        </div>
        <div class="col-md-9">
            <ul class="list-group">
                @foreach ($people as $person)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <img src="https://via.placeholder.com/50" loading="lazy" class="rounded-circle mr-3"
                            alt="Avatar">
                        <div>
                            <strong>{{ $person['user_name'] }}</strong><br>
                            <small>{{ $person['position'] }}</small>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        @php
                        // التحقق من حالات المتابعة
                        $connection = DB::table('connections')
                        ->where('follower_id', $person['id'])
                        ->where('following_id', auth()->id())
                        ->first();

                        // تحقق من حالات مختلفة
                        $isFollowing = $connection && $connection->is_accepted == 1; // متابعة فعلية
                        $isRequested = $connection && $connection->is_accepted == 0; // طلب قيد الانتظار
                        @endphp

                        <button class="btn
{{ $isFollowing ? 'btn-outline-danger' : ($isRequested ? 'btn-outline-warning' : 'btn-outline-primary') }}
btn-sm" wire:click="{{ !$isRequested ? ($isFollowing ? 'unFollow(' . $person['id'] . ')' : 'follow(' . $person['id'] . ')') : '' }}">
                            {{ $isFollowing ? 'UnFollow' : ($isRequested ? 'Requested' : 'Follow') }}
                        </button>

                        <!-- Conditionally display the Connect button -->
                        @if ($isFollowing)
                        <button wire:click.prevent="startConversation({{$person['id']}})" class="ml-2 btn btn-outline-primary mr-2 flex-shrink-0 p-1 w-50">Connect</button>
                        @endif


                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>