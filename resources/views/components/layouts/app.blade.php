<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Page Title' }}</title>
    @livewireStyles

</head>

<body>
    <ul>
        <li><a href="{{ route('login') }}">Login</a></li>
        <li><a href="{{ route('logout') }}">Logout</a></li>
        <li>
            <form action="{{ route('logout') }}" method="post">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </li>
    </ul>
    {{ $slot }}

    @livewireScripts
</body>

</html>
