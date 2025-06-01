@push('styles')
    <link rel="stylesheet" href="{{ asset('css/myNetwork.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/search.css') }}">
@endpush

<div>
    <div class="card shadow-sm rounded border">
        <div class="card-header bg-white border-bottom-0 rounded">
            <h5 class="card-title fw-semibold my-2">{{ __('general.manage_network') }}</h5>
        </div>

        <div class="card-body p-0">
            <div class="list-group list-group-flush rounded">
                <a href="/Following"
                    class="list-group-item list-group-item-action d-flex justify-content-between align-items-center py-3 {{ request()->is('Following') ? 'active-item' : '' }}">
                    <div>
                        <i class="fas fa-user-friends me-2"></i>
                        <span
                            class="{{ request()->is('Following') ? 'fw-bold' : '' }}">{{ __('general.following') }}</span>
                    </div>
                    <span class="badge bg-light text-dark rounded-pill">{{ $countFollowings }}</span>
                </a>

                <a href="/Followers"
                    class="list-group-item list-group-item-action d-flex justify-content-between align-items-center py-3 {{ request()->is('Followers') ? 'active-item' : '' }}">
                    <div>
                        <i class="fas fa-users me-2"></i>
                        <span
                            class="{{ request()->is('Followers') ? 'fw-bold' : '' }}">{{ __('general.followers') }}</span>
                    </div>
                    <span class="badge bg-light text-dark rounded-pill">{{ $countFollowers }}</span>
                </a>

                <a href="/CompaniesList"
                    class="list-group-item list-group-item-action d-flex justify-content-between align-items-center py-3 {{ request()->is('CompaniesList') ? 'active-item' : '' }}">
                    <div>
                        <i class="fas fa-building me-2"></i>
                        <span
                            class="{{ request()->is('CompaniesList') ? 'fw-bold' : '' }}">{{ __('general.companies') }}</span>
                    </div>
                    <span class="badge bg-light text-dark rounded-pill">{{ $countCompanies }}</span>
                </a>
            </div>
        </div>
    </div>
</div>
