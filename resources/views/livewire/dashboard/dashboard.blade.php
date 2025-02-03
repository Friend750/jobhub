@push('styles')
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endpush
<div>
    <div class="row w-100">
        <!-- Sidebar -->
        <div class="col-md-2">
            <div class="bg-dark text-white d-flex flex-column justify-content-start fixed-sidebar">

                <h2 class="text-start py-4 px-3"> {{ __('general.dashboard') }}</h2>
                <ul class="nav flex-column px-3">
                    <li class="nav-item mb-2 {{ $currentSection === 'home' ? 'active' : '' }}">
                        <a class="nav-link text-white" href="#" wire:click.prevent="switchSection('home')">
                            <i class="bi bi-house"></i> <span>{{ __('general.home') }}</span>
                        </a>
                    </li>
                    <li class="nav-item mb-2 {{ $currentSection === 'users' ? 'active' : '' }}">
                        <a class="nav-link text-white" href="#" wire:click.prevent="switchSection('users')">
                            <i class="bi bi-people"></i> <span>{{ __('general.users') }}</span>
                        </a>
                    </li>
                    <li class="nav-item mb-2 {{ $currentSection === 'jobs' ? 'active' : '' }}">
                        <a class="nav-link text-white" href="#" wire:click.prevent="switchSection('jobs')">
                            <i class="bi bi-file-earmark"></i> <span>{{ __('general.jobs') }}</span>
                        </a>
                    </li>
                </ul>

            </div>
        </div>

        <!-- Content Area -->
        <div class="col-md-10">
            <div class="content-area p-3">
                @if ($currentSection === 'users')
                    @livewire('dashboard.users-table')
                @elseif ($currentSection === 'jobs')
                    @livewire('dashboard.jobs-table')
                @elseif($currentSection === 'home')
                    @include('livewire.includes.dashboard.home')
                @endif
            </div>
        </div>
    </div>
</div>
