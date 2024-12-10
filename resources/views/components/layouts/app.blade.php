<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    @if (in_array(Route::currentRouteName(), ['typeaccount']))
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/search.css') }}">
    @endif

    @if (in_array(Route::currentRouteName(), ['search']))
    <link rel="stylesheet" href="{{ asset('css/typeaccount.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/search.css') }}">
    @endif


    @if (in_array(Route::currentRouteName(), ['user-profile']))
    <link rel="stylesheet" href="{{ asset('css/userProfile.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/search.css') }}">
    @endif


    @if (in_array(Route::currentRouteName(), ['interests']))
    <link rel="stylesheet" href="{{ asset('css/Intrests.css') }}">
    @endif


    @if (in_array(Route::currentRouteName(), ['post','route']))
    <link rel="stylesheet" href="{{ asset('css/post.css') }}">
    <link rel="stylesheet" href="{{ asset('css/creat-post-overlay.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/search.css') }}">
    @endif

    @if (in_array(Route::currentRouteName(), ['FollowersScreen','CompaniesScreen','FollowingsScreen']))
    <link rel="stylesheet" href="{{ asset('css/myNetwork.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/search.css') }}">
    @endif

    @if (in_array(Route::currentRouteName(), ['notifications']))
    <link rel="stylesheet" href="{{ asset('css/notifications.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/search.css') }}">
    @endif

    @if (in_array(Route::currentRouteName(), ['home']))
    <link rel="stylesheet" href="{{ asset('css/homePage.css') }}">
    <link rel="stylesheet" href="{{ asset('css/homePageNav.css') }}">

    @endif

    @if (in_array(Route::currentRouteName(), ['jobScreen']))
    <link rel="stylesheet" href="{{ asset('css/jobScreen.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/search.css') }}">
    @endif

    @if (in_array(Route::currentRouteName(), ['EnhanceProfile']))
    <link rel="stylesheet" href="{{ asset('css/enhanceProfile.css') }}">
    @endif

    @if (in_array(Route::currentRouteName(), ['chat']))
    <link rel="stylesheet" href="{{ asset('css/chat.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/search.css') }}">
    @endif



    {{-- make all css files above this line --}}

    <title>{{ $title ?? 'Page Title' }}</title>
    @livewireStyles

</head>

<body>
    {{-- <ul>
        <li><a href="{{ route('login') }}">Login</a></li>
        <li><a href="{{ route('register') }}">Register</a></li>
        <li>
            <form action="{{ route('logout') }}" method="post">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </li>
    </ul> --}}

@if (!in_array(Route::currentRouteName(), ['login', 'register', 'typeaccount', 'interests','home','EnhanceProfile']))
@include('livewire.navigation-bar')
@endif

<div class="row">
    <div class="col-12">
        {{ $slot }}
    </div>
</div>




    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="{{ asset('js/chat.js') }}"></script>
    @livewireScripts
</body>

</html>
