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
                    <strong class="slash">|</strong>People
                </a>

                <!-- Company Link -->
                <a href="#" class="list-group-item list-group-item-action {{ $activeTab === 'company' ? 'stick' : '' }}"
                    wire:click.prevent="switchTab('company')">
                    <strong class="slash">|</strong>Company
                </a>
            </div>

        </div>
        <div class="col-md-9">
            <span class="bg-light text-dark fw-bold px-2 py-1 rounded shadow-sm">
                {{$query}}
            </span>

            <ul class="list-group mt-3">
                @if (count($people) > 0)
                    @foreach ($people as $person)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <img class="rounded-circle mr-3" src="{{ $person['profile_image'] ?? 'default-profile.png' }}"">
                            <div>
                                <strong>{{ $person['user_name'] }}</strong><br>
                                <small>{{ $person['position'] }}</small>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            @php
                            // Check follow statuses
                            $connection = DB::table('connections')
                            ->where('follower_id', $person['id'])
                            ->where('following_id', auth()->id())
                            ->first();
            
                            $isFollowing = $connection && $connection->is_accepted == 1; // Active following
                            $isRequested = $connection && $connection->is_accepted == 0; // Pending request
                            @endphp
            
                            <button class="btn slash
                            {{ $isFollowing ? 'btn-outline-danger' : ($isRequested ? 'btn-outline-warning' : 'btn-outline-primary') }}
                            btn-sm" wire:click="{{ !$isRequested ? ($isFollowing ? 'unFollow(' . $person['id'] . ')' : 'follow(' . $person['id'] . ')') : '' }}">
                                {{ $isFollowing ? 'UnFollow' : ($isRequested ? 'Requested' : 'Follow') }}
                            </button>
            
                            @if ($isFollowing)
                            <button wire:click.prevent="startConversation({{$person['id']}})" class="btn btn-outline-primary flex-shrink-0 p-1 w-50">Connect</button>
                            @endif
                        </div>
                    </li>
                    @endforeach
                @else
                    <li class="mt-3 list-group-item text-center text-muted">
                        No results found
                    </li>
                @endif
            </ul>
            
            @if ($hasMore)
            <div class="d-flex justify-content-center mt-3">
                <button wire:click="loadMore" class="btn btn-outline-primary w-100 mb-3">
                    Load More
                </button>
            </div>
            @endif
        </div>
    </div>
</div>