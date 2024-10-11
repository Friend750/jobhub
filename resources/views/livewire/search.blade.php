@include('livewire.navigation-bar')
<head><link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/search.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

</head>
<div class="container mt-5 col-8">
    <div class="row">
        <div class="col-md-3">
            <div class="list-group">
                <a href="#" class="list-group-item list-group-item-action">People</a>
                <a href="#" class="list-group-item list-group-item-action end">Company</a>
            </div>
        </div>
        <div class="col-md-9">
            <ul class="list-group">
                @foreach($people as $person)
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
                            <button class="btn {{ $person['is_following'] ? 'btn-outline-danger' : 'btn-primary' }} flex-shrink-0" wire:click="toggleFollow({{ $person['id'] }})">
                                <i class="{{ $person['is_following'] ? 'bi-person-dash-fill' : 'bi-person-plus-fill' }}"></i> 
                                {{ $person['is_following'] ? 'Unfollow' : 'Follow' }}
                            </button>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>