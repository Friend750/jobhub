@push('styles')
    <link rel="stylesheet" href="{{ asset('css/followedsList.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/search.css') }}">
@endpush

<div class="mt-5 pt-4 row justify-content-center">
    <div class="col-lg-3 p-0 d-flex justify-content-end">
        <div class="MakeSticky w-75" style="
        height: fit-content;">
            @livewire('manage-network')
        </div>
    </div>

    <div class="col-md-5 bg-light container">
        <div class="mt-1 d-inline-flex gap-2 w-100 p-2 rounded">
            <button wire:click="switchTypeLoadData('user')"
                class="btn {{ $type === 'user' ? 'btn-primary' : 'btn-outline-primary' }}
                       btn-sm fw-semibold rounded-0">
                أشخاص
            </button>

            <button wire:click="switchTypeLoadData('company')"
                class="btn {{ $type === 'company' ? 'btn-primary' : 'btn-outline-primary' }}
                       btn-sm fw-semibold rounded-0">
                شركات
            </button>
        </div>
        <div class="border-top mt-2 mb-2" style="height: 1px;"></div>
        <div id="followers-list">
            @forelse ($users as $user)
                @php
                    $status = $this->getFollowStatus($user->id);
                    $isFollowing = $status['isFollowing'];
                    $isRequested = $status['isRequested'];
                @endphp

                <div class="mb-2">
                    <div class="card-body d-flex align-items-center justify-content-between"
                        wire:key="user-{{ $user->id }}">
                        <div style="cursor: pointer" class="d-flex align-items-center mb-2" x-data
                            @click="fetch(`/users/{{ $user['id'] }}/ping`, { method: 'GET' })"
                            wire:click='showUser({{ $user['id'] }})'>
                            <img src="{{ $user->user_image ?? 'https://ui-avatars.com/api/?name=' . urlencode($user->fullName()) }}"
                                alt="Logo" class="rounded-circle ms-2" width="40">
                            <div>
                                <h5 class="mb-0">{{ $user->page_name ?? $user->fullName() }}</h5>
                                <small
                                    class="text-muted">{{ $user->personal_details->specialist ?? 'No specialist available' }}</small>
                                <br>
                                <small class="text-muted">
                                    عدد المتابعين: {{ $user->accepted_all_followers_count ?? 0 }}
                                </small>
                                <br>


                            </div>


                        </div>

                        {{-- زر المتابعة --}}
                        <div class="d-flex align-items-center" wire:ignore x-data="{
                            isFollowing: @json($isFollowing),
                            isRequested: @json($isRequested)
                        }">
                            <button class="btn btn-sm"
                                :class="isFollowing ? 'btn-secondary' : (isRequested ? 'btn-secondary' :
                                    'btn-primary')"
                                @click.prevent="
                                if (!isRequested) {
                                    if (isFollowing) {
                                        isFollowing = false;
                                        $wire.unFollow({{ $user->id }});
                                    } else {
                                        isRequested = true;
                                        $wire.follow({{ $user->id }});
                                    }
                                }
                            ">
                                <span
                                    x-text="isFollowing ? '{{ __('general.unfollow') }}' : (isRequested ? '{{ __('general.requested') }}' : '{{ __('general.follow') }}')"></span>
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-4 text-muted">
                    {{ __('general.no_followeds') }}
                </div>
            @endforelse


            @if ($type === 'company' && $hasMoreCompanies)
                <div class="text-center py-3">
                    <button wire:click="loadMore" wire:loading.attr="disabled" class="btn btn-primary">
                        تحميل المزيد
                        <span wire:loading wire:target="loadMore" class="spinner-border spinner-border-sm ms-2"
                            role="status" aria-hidden="true"></span>
                    </button>
                </div>
            @endif

            @if ($type === 'user' && $hasMoreUsers)
                <div class="text-center py-3">
                    <button wire:click="loadMore" wire:loading.attr="disabled" class="btn btn-primary">
                        تحميل المزيد
                        <span wire:loading wire:target="loadMore" class="spinner-border spinner-border-sm ms-2"
                            role="status" aria-hidden="true"></span>
                    </button>
                </div>
            @endif

        </div>
    </div>

    <div class="col-lg-3 p-0">
        <div class="MakeSticky w-75">
            @livewire('ChatAndFeed')
        </div>
    </div>
</div>
