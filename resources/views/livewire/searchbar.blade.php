<div style="display: inline-block; width: 100%;" x-data="{ open: false }" @click.away="open = false"
    x-init="$watch('open', value => $wire.set('showDropdown', value))">
    <form wire:submit.prevent="search" class="d-flex">
        @csrf
        <div class="input-group position-relative">
            <input wire:model.live.debounce.200ms="query" class="form-control text-end border-start-0" type="search"
                placeholder="{{ __('general.search_placeholder') }}" aria-label="{{ __('general.search') }}" dir="rtl"
                @focus="open = true" x-ref="searchInput">
            <span class="input-group-text rounded-0 rounded-start">
                <i class="bi bi-search text-primary"></i>
            </span>

            @if($showDropdown)
                <div class="position-absolute w-100 z-3 mt-2" style="top: 100%; left: 0;">
                    <div class="bg-white border rounded shadow-lg" style="width: fit-content">
                        @if(count($results) > 0)
                                @foreach($results as $user)
                                        <a href="#" class="d-block p-3 text-decoration-none text-dark hover-bg-light" x-data
                                        x-data
                                        @click="fetch(`/users/{{  $user->id  }}/ping`, { method: 'GET' })"
                                        wire:click='showUser({{  $user->id }})' wire:key="{{ $user->id }}">
                                            <div class="d-flex align-items-start gap-3">
                                                <img src="{{ $user->user_image
                                    ? (strpos($user->user_image, 'googleusercontent.com') !== false
                                        ? $user->user_image
                                        : asset('storage/' . $user->user_image))
                                    : 'https://ui-avatars.com/api/?name=' . urlencode($user->fullName()) }}"
                                                    class="rounded-circle" style="width: 50px; height: 50px; object-fit: cover;"
                                                    alt="{{ $user->user_name }}">
                                                <div class="text-end" style="min-width: 0; flex: 1 1 auto;">
                                                    <div class="fw-bold text-truncate" style="max-width: 200px;">
                                                        {{  $user->page_name ?? $user->fullName() }}
                                                    </div>
                                                    <small class="d-block">
                                                        {{ $user->personal_details->specialist ?? ''}}
                                                    </small>
                                                </div>
                                            </div>
                                        </a>
                                @endforeach
                        @else
                            <div class="p-3 text-center text-muted py-4">
                                <i class="bi bi-search-x fs-5 d-block mb-2"></i>
                                <span>@lang('No results found')</span>
                            </div>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </form>
</div>
