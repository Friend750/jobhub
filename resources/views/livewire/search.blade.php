@push('styles')
<link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
<link rel="stylesheet" href="{{ asset('css/search.css') }}">
@endpush

<div class="container col-md-9" style="margin-top: 5.2rem !important;">
    <div class="row">
        <div class="col-md-3">
            <div class="list-group">
                <!-- People Link -->
                <a href="#People" class="list-group-item list-group-item-action">
                    <strong class="slash">|</strong> {{ __('general.people') }}
                </a>

                <!-- Company Link -->
                <a href="#Companies" class="list-group-item list-group-item-action">
                    <strong class="slash">|</strong> {{ __('general.companies') }}
                </a>
            </div>
        </div>
        <div class="col-md-9">
            <span id="People">{{ __('general.people') }}</span>
            <ul class="list-group mt-3">
                @if (count($people) > 0)
                    @foreach ($people as $person)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <img class="rounded-circle mr-3" src="{{ $person['profile_image'] ?? 'default-profile.png' }}">
                            <div>
                                <strong>{{ $person['user_name'] }}</strong><br>
                                <small>{{ $person['position'] ?? __('general.position') }}</small>
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
                                {{ $isFollowing ? __('general.unfollow') : ($isRequested ? __('general.requested') : __('general.follow')) }}
                            </button>
            
                            @if ($isFollowing)
                            <button wire:click.prevent="startConversation({{ $person['id'] }})" class="btn btn-outline-primary flex-shrink-0 p-1 w-50">
                                {{ __('general.connect') }}
                            </button>
                            @endif
                        </div>
                    </li>
                    @endforeach
                @else
                    <li class="mb-3 list-group-item text-center text-muted">
                        {{ __('general.no_results') }}
                    </li>
                @endif
            </ul>
            
            @if ($hasMorePeople)
            <div class="d-flex justify-content-center mt-3">
                <button wire:click="loadMorePeople" class="btn btn-outline-primary w-100 mb-3">
                    {{ __('general.load_more') }}
                </button>
            </div>
            @endif
        </div>

        <div class="col-md-3">
        </div>

        <div class="col-md-9">
            <span id="Companies">{{ __('general.companies') }}</span>
            <ul class="list-group mt-3">
                @if (count($companies) > 0)
                    @foreach ($companies as $company)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <img class="rounded-circle mr-3" src="{{ $company['profile_image'] ?? 'default-profile.png' }}">
                            <div>
                                <strong>{{ $company['user_name'] }}</strong><br>
                                <small>{{ $company['position'] ?? __('general.position') }}</small>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            @php
                            // Check follow statuses
                            $connection = DB::table('connections')
                            ->where('follower_id', $company['id'])
                            ->where('following_id', auth()->id())
                            ->first();
            
                            $isFollowing = $connection && $connection->is_accepted == 1; // Active following
                            $isRequested = $connection && $connection->is_accepted == 0; // Pending request
                            @endphp
            
                            <button class="btn slash
                            {{ $isFollowing ? 'btn-outline-danger' : ($isRequested ? 'btn-outline-warning' : 'btn-outline-primary') }}
                            btn-sm" wire:click="{{ !$isRequested ? ($isFollowing ? 'unFollow(' . $company['id'] . ')' : 'follow(' . $company['id'] . ')') : '' }}">
                                {{ $isFollowing ? __('general.unfollow') : ($isRequested ? __('general.requested') : __('general.follow')) }}
                            </button>
            
                            @if ($isFollowing)
                            <button wire:click.prevent="startConversation({{ $company['id'] }})" class="btn btn-outline-primary flex-shrink-0 p-1 w-50">
                                {{ __('general.connect') }}
                            </button>
                            @endif
                        </div>
                    </li>
                    @endforeach
                @else
                    <li class="list-group-item text-center text-muted">
                        {{ __('general.no_results') }}
                    </li>
                @endif
            </ul>
            
            @if ($hasMoreCompanies)
            <div class="d-flex justify-content-center mt-3">
                <button wire:click="loadMoreCompanies" class="btn btn-outline-primary w-100 mb-3">
                    {{ __('general.load_more') }}
                </button>
            </div>
            @endif
        </div>
    </div>
</div>
