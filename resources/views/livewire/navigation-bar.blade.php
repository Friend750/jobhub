<!-- Navbar -->
<nav id="navbar" class="navbar navbar-light nav-bg-light w-100 mb-5">
    <div class="container-fluid">
        <div class="nav-left d-flex justify-content-center align-items-center">
            <a class="navbar-brand" href="#">
                <span class="logoName ms-3">{{ __('general.logo') }}</span>
            </a>
            @livewire('searchbar')
        </div>


        <div class="nav-right">
            <div class="navbar-icons ms-auto">
                <a href="/posts"
                    class="nav-link d-flex flex-column align-items-center {{ Route::is('post') ? 'active' : '' }}">
                    <i class="bi bi-house-door-fill"></i>
                    <span>{{ __('general.home') }}</span>
                </a>
                <a href="/Following"
                    class="nav-link d-flex flex-column align-items-center {{ Route::is('FollowingsScreen') ? 'active' : '' }}">
                    <i class="bi bi-people-fill"></i>
                    <span>{{ __('general.network') }}</span>
                </a>
                <a href="/JobList"
                    class="nav-link d-flex flex-column align-items-center {{ Route::is('jobList') ? 'active' : '' }}">
                    <i class="bi bi-briefcase-fill"></i>
                    <span>{{ __('general.jobs') }}</span>
                </a>
                <a href="/chat"
                    class="nav-link d-flex flex-column align-items-center {{ Route::is('chat') ? 'active' : '' }}">
                    <i class="bi bi-chat-dots-fill"></i>
                    <span>{{ __('general.messages') }}</span>
                </a>
                <a href="/notifications"
                    class="nav-link d-flex flex-column align-items-center position-relative {{ Route::is('notifications') ? 'active' : '' }}">
                    <i class="bi bi-bell-fill"></i>
                    <span>
                        {{ __('general.notifications') }}
                        @if ($countNotifications > 0)
                            <span class="ms-4 badge bg-danger notification-badge position-absolute">
                                {{ $countNotifications }}
                            </span>
                        @endif
                    </span>
                </a>
            </div>
            <div x-data="{ open: false }" class="position-relative">
                <!-- Trigger -->
                <a @click="open = !open" @click.outside="open = false" class="nav-link cursor-pointer" href="#"
                    role="button" aria-expanded="false" :aria-expanded="open.toString()">
                    <div class="nav-link d-flex flex-column align-items-center">
                        <i class="bi bi-person-circle"
                            style="
                        font-size: 22px;
                        margin-bottom: -5px;
                    "></i>
                        <span style="
                        font-size: 12px;">
                            {{ __('general.profile') }}</span>
                    </div>
                </a>

                <!-- Dropdown -->
                <ul x-show="open" x-transition.origin.top.left
                    class="position-absolute z-50 start-0 mt-3 w-56 shadow-lg p-0 border-0 rounded-md bg-white dark:bg-gray-800"
                    style="display: none;">
                    @livewire('user-profile-card')
                </ul>
            </div>

        </div>
    </div>
</nav>

<script>
    let lastScrollTop = 0;
    const navbar = document.getElementById('navbar');

    window.addEventListener('scroll', () => {
        const currentScroll = window.pageYOffset || document.documentElement.scrollTop;

        if (currentScroll > lastScrollTop) {
            // Scrolling down - hide navbar
            navbar.classList.add('hidden');
        } else {
            // Scrolling up - show navbar
            navbar.classList.remove('hidden');
        }

        lastScrollTop = currentScroll <= 0 ? 0 : currentScroll; // Prevent negative scroll
    });
</script>
