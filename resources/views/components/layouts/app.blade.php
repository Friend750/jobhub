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





    {{-- favicon --}}
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('favicon/site.webmanifest') }}">

    <!-- jQuery required for select2 using -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    {{-- select2 js and css --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    {{-- bootstrap theme link with select2 --}}
    <link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.0.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" />

    {{-- <script type="module" src="{{ Vite::asset('resources/js/bootstrap.js') }}"></script> --}}



    {{-- main app css --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    {{-- routes assets --}}
    @if (in_array(Route::currentRouteName(), ['typeaccount']))
        <link rel="stylesheet" href="{{ asset('css/typeaccount.css') }}">
    @endif

    @if (in_array(Route::currentRouteName(), ['search']))
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


    @if (in_array(Route::currentRouteName(), ['post']))
        <link rel="stylesheet" href="{{ asset('css/post.css') }}">
        <link rel="stylesheet" href="{{ asset('css/creat-post-overlay.css') }}">
        <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
        <link rel="stylesheet" href="{{ asset('css/search.css') }}">
    @endif

    @if (in_array(Route::currentRouteName(), ['FollowersScreen', 'CompaniesScreen', 'FollowingsScreen']))
        <link rel="stylesheet" href="{{ asset('css/myNetwork.css') }}">
        <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
        <link rel="stylesheet" href="{{ asset('css/search.css') }}">
    @endif

    @if (in_array(Route::currentRouteName(), ['notifications']))
        <link rel="stylesheet" href="{{ asset('css/notifications.css') }}">
        <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
        <link rel="stylesheet" href="{{ asset('css/search.css') }}">
    @endif

    @if (in_array(Route::currentRouteName(), ['home', 'route']))
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

    @if (in_array(Route::currentRouteName(), ['dashboard']))
        <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    @endif



    {{-- make all css files above this line --}}

    <title>{{ $title ?? 'Page Title' }}</title>

</head>


@if (
    !in_array(Route::currentRouteName(), [
        'dashboard',
        'users-table',
        'route',
        'login',
        'register',
        'typeaccount',
        'interests',
        'home',
        'EnhanceProfile',
    ]))
    @include('livewire.navigation-bar')
@endif

{{ $slot }}








<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
