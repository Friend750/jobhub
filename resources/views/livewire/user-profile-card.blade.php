<style>
    .card-img {
        object-fit: cover;
        background-color: #f8f9fa;
        width: 80px;
        height: 80px;
        border: 4px solid;
    }

    .nav-list-item {
        transition: all 0.3s ease;
        border: 1px solid transparent;
    }

    .nav-list-item:hover {
        background-color: rgba(43, 109, 174, 0.08);
    }

    .nav-list-item i {
        transition: transform 0.3s ease;
        color: #2B6DAE;
        font-size: 18px !important;
        /* matching blue */
    }
</style>
<div class="card">
    <img src="{{ $user->user_image_url }}" class="card-img-top" alt="..."
        style="
    /* background: #df3; */
    height: 120px;
    background: darkblue;
    object-fit: cover;">

    <div class="card-body cardprofile text-end p-3" style="min-width: 230px;">

        <div class="mb-3 text-center ">
            <h5 class="mb-0">{{ $user->personal_details->first_name ?? '' }}
                {{ $user->personal_details->last_name ?? '' }}
            </h5>
            <span class="badge bg-secondary text-light"
                style="width: fit-content">{{ $user->user_name ?? __('general.user_name') }}</span>

        </div>


        <div class="mt-2 text-dark">
            <!-- user profile -->
            <a href="{{ route('user-profile') }}"
                class="d-flex justify-content-between align-items-center mb-2 px-2 py-1 nav-link rounded nav-list-item">
                <small class="fw-medium">
                    {{ __('general.view_profile') }}
                </small>
                <i class="text-dark fas fa-user"></i>
            </a>

            <!-- Language -->
            @if (app()->getLocale() == 'en')
                <a href="{{ route('lang.switch', 'ar') }}"
                    class="d-flex justify-content-between align-items-center mb-2 px-2 py-1 nav-link rounded nav-list-item">
                    <small class="fw-medium">
                        {{ __('general.language') }}
                    </small>
                    <i class="text-dark fas fa-language"></i>
                </a>
            @else
                <a href="{{ route('lang.switch', 'en') }}"
                    class="d-flex justify-content-between align-items-center mb-2 px-2 py-1 nav-link rounded nav-list-item">
                    <small class="fw-medium">
                        {{ __('general.language') }}
                    </small>
                    <i class="text-dark fas fa-language"></i>
                </a>
            @endif



            <a href="{{ route('welcomeCareerAI') }}"
                class="d-flex justify-content-between align-items-center mb-2 px-2 py-1 nav-link rounded nav-list-item">
                <small class="fw-medium">
                    {{ __('general.careerAI') }} AI
                    <span class="badge bg-secondary text-light" style="font-size: xx-small">
                        Beta
                    </span>
                </small>
                <i class="text-dark bi bi-stars"></i>


            </a>

            @guest
                <!-- Login -->
                <a class="d-flex justify-content-between align-items-center mb-2 px-2 py-1 nav-link rounded nav-list-item"
                    href="{{ route('login') }}">
                    <small class="fw-medium">
                        {{ __('general.login') }}
                    </small>
                    <i class="text-dark fas fa-sign-in-alt"></i>
                </a>

                <!-- Register -->
                <a class="d-flex justify-content-between align-items-center mb-2 px-2 py-1 nav-link rounded nav-list-item"
                    href="{{ route('register') }}">
                    <small class="fw-medium">
                        {{ __('general.register') }}
                    </small>
                    <i class="text-dark fas fa-user-plus"></i>
                </a>
            @endguest

            @auth
                @if ($user->type === 'admin')
                    <!-- Dashboard -->
                    <a href="{{ route('dashboard') }}"
                        class="d-flex justify-content-between align-items-center mb-2 px-2 py-1 nav-link rounded nav-list-item">
                        <small class="fw-medium">
                            {{ __('general.dashboard') }}
                        </small>
                        <i class="text-dark fas fa-tachometer-alt"></i>
                    </a>
                @endif

                <form id="logout-form" action="{{ route('logout') }}" method="post" style="display: none;">
                    @csrf
                </form>

                <!-- Logout -->
                <a href="#"
                    class="d-flex justify-content-between align-items-center mb-2 px-2 py-1 nav-link rounded nav-list-item"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <small class="fw-medium">
                        {{ __('general.logout') }}
                    </small>
                    <i class="text-dark fas fa-sign-out-alt"></i>
                </a>
            @endauth
        </div>
    </div>
</div>
