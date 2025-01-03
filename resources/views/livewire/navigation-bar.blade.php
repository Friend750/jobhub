<!-- Navbar -->
<nav class="navbar navbar-light nav-bg-light w-100">
    <div class="container-fluid">
        <div class="nav-left d-flex justify-content-center align-items-center">
            <a class="navbar-brand" href="#">
                <span class="logoName">YemenJobs</span>
            </a>
            @livewire('searchbar')
        </div>

        <div class="nav-right">

            <div class="navbar-icons ms-auto">
                <a href="/posts"  class="nav-link d-flex flex-column align-items-center">
                    <i class="bi bi-house-door-fill"></i>
                    <span>Home</span>
                </a>
                <a href="/Following"  class="nav-link d-flex flex-column align-items-center">
                    <i class="bi bi-people-fill"></i>
                    <span>Network</span>
                </a>
                <a href="/JobScreen"  class="nav-link d-flex flex-column align-items-center">
                    <i class="bi bi-briefcase-fill"></i>
                    <span>Jobs</span>
                </a>
                <a href="/chat"  class="nav-link d-flex flex-column align-items-center">
                    <i class="bi bi-chat-dots-fill"></i>
                    <span>Messages</span>
                </a>
                <a href="/notifications"  class="nav-link d-flex flex-column align-items-center">
                    <i class="bi bi-bell-fill"></i>
                    <span>Notifications</span>
                </a>
            </div>

            <div class="dropdown">
                <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="d-flex flex-column align-items-center ">
                        <i class="bi bi-person-circle"></i>
                        <span>Profile</span>
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    @livewire('user-profile-card')
                </ul>
            </div>

        </div>
    </div>
</nav>
