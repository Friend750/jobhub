<div class="container" style="margin-top: 5.5rem !important;">
    <div class="row">
        <!-- Manage Network Section -->
        @livewire('manage-network')

        <!-- Followers List Section -->
        <div class="col-md-8 containerOfNetwork">
            <div class="mb-3 d-flex justify-content-between align-items-center">
                <h4 class="mt-3">{{ __('general.followers') }}</h4>
            </div>
            @foreach ($followers as $follower)
                <div class="d-flex justify-content-between align-items-center border-bottom py-2 position-relative">
                    <div class="d-flex align-items-center">
                        <!-- Default avatar image -->
                        <img src="https://ui-avatars.com/api/?name=Image" alt="Logo"
                            class="rounded-circle ms-2" width="40">
                        <div class="ms-3">
                            <strong>{{ $follower['user_name'] }}</strong>
                            <div class="text-muted">{{ $follower['position'] ?? __('general.position') }}</div>
                        </div>
                    </div>

                    <div class="dropdown">
                        <!-- More options icon -->
                        <i class="fa-solid fa-ellipsis-vertical btn" id="dropdownMenuButton{{ $follower['id'] }}"
                            data-bs-toggle="dropdown" aria-expanded="false" style="cursor: pointer;"></i>
                        <!-- Dropdown menu -->
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton{{ $follower['id'] }}">
                            <li><button wire:click='deleteConnection({{ $follower['id'] }})' class="dropdown-item">
                                {{ __('general.remove_follower') }}
                            </button></li>
                            <li><a   x-data
                                @click="fetch(`/users/{{ $follower['id'] }}/ping`, { method: 'GET' })" class="dropdown-item" href="#">{{ __('general.view_profile') }}</a></li>
                        </ul>
                        <a
                        href="#"
                        wire:click.prevent="startConversation({{ $follower['id'] }})"
                        class="btn"
                    >
                        <i class="fa-regular fa-paper-plane"></i>
                    </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>


