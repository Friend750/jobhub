@extends('layouts.app')

@section('Title', 'Register')


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card p-4 shadow-sm mt-1 col-md-4 col-sm-8">

                <div class="card-body">
                    <h2 class="">{{ __('Register') }}</h2>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="">
                            <label for="name" class="col-form-label text-md-end">{{ __('Name') }}</label>

                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                name="name" value="{{ old('name') }}" autocomplete="name" autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <small>{{ $message }}</small>
                                </span>
                            @enderror
                        </div>

                        <div class="">
                            <label for="email" class="col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <small>{{ $message }}</small>
                                </span>
                            @enderror
                        </div>

                        <div class="">
                            <label for="password" class="col-form-label text-md-end">{{ __('Password') }}</label>

                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password"
                                autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <small>{{ $message }}</small>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password-confirm"
                                class="col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                                autocomplete="new-password">

                        </div>

                        {{-- <div class="d-flex justify-content-end align-items-center mb-3">

                            <button type="button" class="position-relative btn" id="hide-show" style="cursor: pointer;"
                                onclick="togglePassword()">Show</button>

                        </div> --}}

                        <div class="row mb-0">
                            <div class="">
                                <div class="mb-3">

                                    <button type="submit" class="btn btn-primary w-100">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                                <button class="btn btn-light w-100 mb-3">
                                    Register with
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/2/2f/Google_2015_logo.svg"
                                        alt="Google G Logo" style="width: 50px; height: auto;">
                                </button>
                                <div class="text-center">
                                    <span>Already have an account?</span>
                                    <a href="/login" class="text-decoration-none"> Sign in</a>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // function togglePassword() {
        //     const passwordField = document.getElementById('password');
        //     const toggleText = document.getElementById('hide-show');
        //     if (passwordField.type === 'password') {
        //         passwordField.type = 'text';
        //         toggleText.innerHTML = 'Hide';
        //     } else {
        //         passwordField.type = 'password';
        //         toggleText.innerHTML = 'Show';
        //     }
        // }
    </script>

@endsection
