@include('livewire.navigation-bar')

<div class="container mt-5 col-md-8">
    <div class="row">
        <div class="col-md-3">
            <div class="list-group">
                <a href="#" class="list-group-item list-group-item-action">People</a>
                <a href="#" class="list-group-item list-group-item-action end">Company</a>
            </div>
        </div>
        <div class="col-md-9">
            <ul class="list-group">
                @foreach ($people as $person)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <img src="https://via.placeholder.com/50" class="rounded-circle mr-3" alt="Avatar">
                            <div>
                                <strong>{{ $person['name'] }}</strong><br>
                                <small>{{ $person['position'] }}</small>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <button class="btn btn-outline-primary mr-2 flex-shrink-0">Connect</button>
                            <button class="btn btn-outline-primary mr-2 flex-shrink-0">
                                <i class="bi-person-plus-fill"></i>
                                Follow</button>
                                {{-- <button type="button" class="btn btn-primary">Primary</button> --}}

                            {{-- <button
                                class="btn {{ $person['is_following'] ? 'btn-outline-danger' : 'btn-primary' }} flex-shrink-0"
                                wire:click="toggleFollow({{ $person['id'] }})">
                                <i
                                    class="{{ $person['is_following'] ? 'bi-person-dash-fill' : 'bi-person-plus-fill' }}"></i>
                                {{ $person['is_following'] ? 'Unfollow' : 'Follow' }}
                            </button> --}}
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
