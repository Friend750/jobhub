<div class="container" style="margin-top: 5.5rem !important;">
    <div class="row">
        <!-- Manage Network Section -->
        <div class="col-lg-3 p-0 d-flex justify-content-end">
            <div class="MakeSticky w-75" style="
            height: fit-content;">
                @livewire('manage-network')
            </div>
        </div>

        <!-- Followers List Section -->
        <div class="col-md-6">
            <div class="card rounded border" style="min-height: 80vh;">
                <div class="p-3 card-img-top text-center text-muted">
                    <h4 class="">{{ __('general.followers') }}</h4>
                </div>

                @forelse ($followers as $follower)
                    <div class="d-flex justify-content-between align-items-center p-3 withHover">
                        <div style="cursor: pointer" class="d-flex align-items-center" x-data
                            @click="fetch(`/users/{{ $follower['id'] }}/ping`, { method: 'GET' })"
                            wire:click='showUser({{ $follower['id'] }})'>
                            <img src="{{$follower['user_image']}}"
                                alt="Logo" class="rounded-circle ms-2"
                                style="object-fit: cover; width: 50px; height: 50px;">
                            <div class="ms-3">
                                <strong>{{ $follower['name'] }}</strong>
                                <div class="text-muted">{{ $follower['position'] ?? __('general.position') }}</div>
                            </div>
                        </div>

                        <div class="d-flex align-items-center">
                            <a href="#" wire:click.prevent="startConversation({{ $follower['id'] }})"
                                class="btn btn-sm me-2">
                                <i class="fa-regular fa-paper-plane"></i>
                            </a>

                            <div class="dropdown">
                                <i class="fas fa-ellipsis-v btn btn-sm" id="dropdownMenuButton{{ $follower['id'] }}"
                                    data-bs-toggle="dropdown" aria-expanded="false" style="cursor: pointer;"></i>
                                <ul class="dropdown-menu dropdown-menu-end"
                                    aria-labelledby="dropdownMenuButton{{ $follower['id'] }}">
                                    <li>
                                        <button wire:click='deleteConnection({{ $follower['id'] }})'
                                            class="dropdown-item">
                                            {{ __('general.remove_follower') }}
                                        </button>
                                    </li>
                                    <li>
                                        <a wire:click.prevent='showUser({{ $follower['id'] }})' class="dropdown-item"
                                            href="#">
                                            {{ __('general.view_profile') }}
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="d-flex justify-content-center align-items-center py-4">
                        <div class="text-muted">
                            {{ __('general.no_followers') }}
                        </div>
                    </div>
                @endforelse
            </div>
        </div>

        <div class="col-lg-3 p-0">
            <div class="MakeSticky w-75">
                @livewire('ChatAndFeed')
            </div>
        </div>

    </div>
</div>
