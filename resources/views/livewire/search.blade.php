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

        <!-- People Section -->
        <div class="col-md-9">
            <span id="People">{{ __('general.people') }}</span>
            <ul class="list-group mt-3">
                @if (count($people) > 0)
                @foreach ($people as $person)
                @php
                // Read status from backend once
                $status = $this->getFollowStatus($person['id']);
                $isFollowing = $status['isFollowing'];
                $isRequested = $status['isRequested'];
                @endphp
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div style="cursor: pointer" class="d-flex align-items-center"  x-data
                    @click="fetch(`/users/{{ $person['id'] }}/ping`, { method: 'GET' })"
                    wire:click='showUser({{ $person['id'] }})'>
                        <img style="width: 40px;" class="rounded-circle ms-3"
                            src="{{ $person['profile_image'] ?? 'https://ui-avatars.com/api/?name=' . urlencode($person->fullName()) }}">
                        <div>
                            <strong>{{ $person->fullName()}}</strong><br>
                            <small>{{ $person['position'] ?? __('general.position') }}</small>
                        </div>
                    </div>
                    <!-- Alpine Component for Follow/Unfollow Button -->
                    <div class="d-flex align-items-center" wire:ignore
                     x-data="{
                                     isFollowing: @json($isFollowing),
                                     isRequested: @json($isRequested)
                                 }">
                        <button class="w-80 btn slash btn-sm"
                            :class="isFollowing ? 'btn-outline-danger' : (isRequested ? 'btn-outline-warning' : 'btn-outline-primary')"
                            @click.prevent="
                                            if (!isRequested) {
                                                if (isFollowing) {
                                                    isFollowing = false;
                                                    $wire.unFollow({{ $person['id'] }});
                                                } else {
                                                    isRequested = true;
                                                    $wire.follow({{ $person['id'] }});
                                                }
                                            }
                                        ">
                            <span
                                x-text="isFollowing ? '{{ __('general.unfollow') }}' : (isRequested ? '{{ __('general.requested') }}' : '{{ __('general.follow') }}')"></span>
                        </button>
                        <!-- Only show connect button if already following -->
                        <button x-show="isFollowing" wire:click.prevent="startConversation({{ $person['id'] }})"
                            class="btn btn-outline-primary flex-shrink-0 p-1 w-90 me-2">
                            {{ __('general.connect') }}
                        </button>
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

        <!-- Companies Section -->
        <div class="col-md-3"></div>
        <div class="col-md-9">
            <span id="Companies">{{ __('general.companies') }}</span>
            <ul class="list-group mt-3">
                @if (count($companies) > 0)
                @foreach ($companies as $company)
                @php
                $status = $this->getFollowStatus($company['id']);
                $isFollowing = $status['isFollowing'];
                $isRequested = $status['isRequested'];
                @endphp
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <img style="width: 40px" class="rounded-circle ms-3"
                            src="{{ $company['profile_image'] ?? 'https://ui-avatars.com/api/?name=' . urlencode($company->fullName()) }}">
                        <div>
                            <strong>{{ $company->page_name ?? $company->fullName() }}</strong><br>
                            <small>{{ $company['position'] ?? __('general.position') }}</small>
                        </div>
                    </div>
                    <div class="d-flex align-items-center" x-data="{
                                     isFollowing: @json($isFollowing),
                                     isRequested: @json($isRequested)
                                 }">
                        <button class="w-80 btn slash btn-sm"
                            :class="isFollowing ? 'btn-outline-danger' : (isRequested ? 'btn-outline-warning' : 'btn-outline-primary')"
                            @click.prevent="
                                            if (!isRequested) {
                                                if (isFollowing) {
                                                    isFollowing = false;
                                                    $wire.unFollow({{ $company['id'] }});
                                                } else {
                                                    isRequested = true;
                                                    $wire.follow({{ $company['id'] }});
                                                }
                                            }
                                        ">
                            <span
                                x-text="isFollowing ? '{{ __('general.unfollow') }}' : (isRequested ? '{{ __('general.requested') }}' : '{{ __('general.follow') }}')"></span>
                        </button>
                        <button x-show="isFollowing" wire:click.prevent="startConversation({{ $company['id'] }})"
                            class="btn btn-outline-primary flex-shrink-0 p-1 w-90 me-2">
                            {{ __('general.connect') }}
                        </button>
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
