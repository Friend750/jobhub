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
                <div class="bg-white border rounded shadow-lg">
                    @if(count($results) > 0)
                    @foreach($results as $user)
                    <a href="#" class="d-block p-3 text-decoration-none text-dark hover-bg-light"
                        wire:key="{{ $user->id }}">
                        <div class="d-flex align-items-center gap-3">
                            <img src="{{ $user->user_image ?? 'https://ui-avatars.com/api/?name=' . $user->user_name }}"
                                class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover;"
                                alt="{{ $user->user_name }}">
                            <div class="text-start" style="min-width: 0; flex: 1 1 auto;">
                                <div class="fw-bold text-truncate" style="max-width: 200px;">
                                    {{ $user->user_name }}
                                </div>
                                <small class="d-block text-truncate" style="max-width: 200px;">{{ $user->type}}</small>
                                <div class="text-primary small">
                                    <i class="bi bi-eye-fill"></i>
                                    {{ number_format($user->views) }} مشاهدة
                                </div>
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