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
                <a href="/posts" class="nav-link d-flex flex-column align-items-center">
                    <i class="bi bi-house-door-fill"></i>
                    <span>{{ __('general.home') }}</span>
                </a>
                <a href="/Following" class="nav-link d-flex flex-column align-items-center">
                    <i class="bi bi-people-fill"></i>
                    <span>{{ __('general.network') }}</span>
                </a>
                <a href="/JobList" class="nav-link d-flex flex-column align-items-center">
                    <i class="bi bi-briefcase-fill"></i>
                    <span>{{ __('general.jobs') }}</span>
                </a>
                <a href="/chat" class="nav-link d-flex flex-column align-items-center">
                    <i class="bi bi-chat-dots-fill"></i>
                    <span>{{ __('general.messages') }}</span>
                </a>
                <a href="/notifications" class="nav-link d-flex flex-column align-items-center position-relative">
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

            <div class="dropdown">
                <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="d-flex flex-column align-items-center">
                        <i class="bi bi-person-circle"></i>
                        <span>{{ __('general.profile') }}</span>
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-start shadow p-0 mt-3 border-0">
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
