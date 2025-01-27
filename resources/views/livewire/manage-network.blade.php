@push('styles')
<link rel="stylesheet" href="{{ asset('css/myNetwork.css') }}">
<link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
<link rel="stylesheet" href="{{ asset('css/search.css') }}">
@endpush
<div class="col-md-4">
    <h4 class="mt-3 mb-3">Manage My Network</h4>

    <ul class="list-unstyled">
        <nav>
            <a href="/Following" class="{{ request()->is('Following') ? 'text-secondary font-weight-bold' : '' }}">
                <li>
                    <i class="fas fa-user-friends mb-3 mr-2"></i>
                    <strong>Following</strong>
                    <span class="ml-2 text-muted">{{ $countFollowings }}</span>
                </li>
            </a>
            <a href="/Followers" class="{{ request()->is('Followers') ? 'text-secondary font-weight-bold' : '' }}">
                <li>
                    <i class="fas fa-users mb-3 mr-2"></i>
                    <strong>Followers</strong>
                    <span class="ml-2 text-muted">{{ $countFollowers }}</span>
                </li>
            </a>
            <a href="/CompaniesList" class="{{ request()->is('CompaniesList') ? 'text-secondary font-weight-bold' : '' }}">
                <li>
                    <i class="fas fa-building ml-1 mr-2"></i>
                    <strong>Companies</strong>
                    <span class="ml-1 text-muted">{{ $countCompanies }}</span>
                </li>
            </a>
        </nav>
    </ul>
</div>
