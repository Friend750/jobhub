<div class="card-body cardprofile text-start p-3" style="width: 230px;">
    <div class="text-center">
        <img src="{{ $user->user_image
            ? asset('storage/' . $user->user_image)
            : 'https://ui-avatars.com/api/?name=' . urlencode($user->user_name) }}"
            class="rounded-circle border shadow-sm mb-2" style="width: 80px;" alt="User Avatar" loading="lazy"
            style="object-fit: cover; background-color: #f8f9fa;">
    </div>
    <h5 class="text-center">{{ $user->user_name ?? __('general.user_name') }}</h5>
    <p class="text-center">{{ __('general.no_info') }}</p>
    <a href="/user-profile" class="btn btn-outline-primary profile rounded w-100">
        {{ __('general.view_profile') }}
    </a>
    <div class="mt-3">
        <a href="#" class="d-block mb-2 nav-link">{{ __('general.language') }}</a>
        @guest
            <a class="d-block mb-2 nav-link" href="{{ route('login') }}">{{ __('general.login') }}</a>
            <a class="d-block mb-2 nav-link" href="{{ route('register') }}">{{ __('general.register') }}</a>
        @endguest
        @auth
            <form id="logout-form" action="{{ route('logout') }}" method="post" style="display: none;">
                @csrf
            </form>
            <a href="#" class="d-block mb-1 nav-link"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                {{ __('general.logout') }}
            </a>
        @endauth
    </div>
</div>
