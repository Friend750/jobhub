<div>
    <div class="row w-100">
        <!-- Sidebar -->
        <div class="col-md-2">
            <div class="bg-dark text-white d-flex flex-column justify-content-start fixed-sidebar">

                <h2 class="text-start py-4 px-3"> Dashboard</h2>
                <ul class="nav flex-column px-3">
                    <li class="nav-item mb-2 {{ $currentSection === 'home' ? 'active' : '' }}">
                        <a class="nav-link text-white" href="#" wire:click.prevent="switchSection('home')">
                            <i class="bi bi-house"></i> <span>Home</span>
                        </a>
                    </li>
                    <li class="nav-item mb-2 {{ $currentSection === 'users' ? 'active' : '' }}">
                        <a class="nav-link text-white" href="#" wire:click.prevent="switchSection('users')">
                            <i class="bi bi-people"></i> <span>Users</span>
                        </a>
                    </li>
                    <li class="nav-item mb-2 {{ $currentSection === 'pages' ? 'active' : '' }}">
                        <a class="nav-link text-white" href="#" wire:click.prevent="switchSection('jobs')">
                            <i class="bi bi-file-earmark"></i> <span>Jobs</span>
                        </a>
                    </li>
                    {{-- <li class="nav-item mb-2">
                        <a class="nav-link text-white" href="#">
                            <i class="bi bi-box-arrow-right"></i> <span>Logout</span>
                        </a>
                    </li> --}}
                </ul>

            </div>


        </div>

        <!-- Content Area -->
        <div class="col-md-10">
            <div class="content-area p-3">

                @if ($currentSection === 'users')
                    @livewire('dashboard.users-table')
                @elseif ($currentSection === 'jobs')
                    <h1>Welcome to the jobs page</h1>
                @elseif($currentSection === 'home')
                    @include('livewire.includes.dashboard.home')
                @endif
            </div>
        </div>
    </div>
</div>
