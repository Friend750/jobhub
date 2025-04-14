@if ($userImage)
    @if (str_contains($userImage, 'googleusercontent.com'))
        {{-- Google account image --}}
        <img src="{{ $userImage }}" alt="Profile Picture" class="rounded-circle"
            style="width: 60px; height: 60px; object-fit: cover;">
    @else
        {{-- Locally stored image --}}
        <img src="{{ asset('storage/' . $userImage) }}" alt="Profile Picture" class="rounded-circle"
            style="width: 60px; height: 60px; object-fit: cover;">
    @endif
@else
    <img src="https://ui-avatars.com/api/?name={{ urlencode($userName) }}&background=random" alt="Profile Picture"
        class="rounded-circle" style="width: 60px; height: 60px; object-fit: cover;">
@endif
