@extends('layouts.app')

@section('Title', 'Login')

@section('content')
<div class="d-flex align-items-center justify-content-center vh-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="card p-4 shadow-sm mt-1 col-md-4 col-sm-8">
                <div class="card-body">
                    <h2 class="mb-4">{{ __('general.Login') }}</h2>
                    <form method="POST" action="{{ route('login') }}" x-data="loginForm">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="col-form-label text-md-end">{{ __('general.Email_Address')
                                }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" x-model="email" autocomplete="email" autofocus>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="col-form-label text-md-end">{{ __('general.Password')
                                }}</label>
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password"
                                x-model="password" autocomplete="current-password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                    x-model="remember">
                                <label class="form-check-label me-4" for="remember">
                                    {{ __('general.Remember_Me') }}
                                </label>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="">

                                <div class="row mb-3">
                                    <div class="">
                                        <button type="submit" class="btn btn-primary w-100" @click="saveCredentials">
                                            {{ __('general.Login') }}
                                        </button>
                                    </div>


                                </div>
                            </div>
                            <div class="d-flex align-items-center mb-3">
                                <hr class="flex-grow-1">
                                <span class="mx-2">Or</span>
                                <hr class="flex-grow-1">
                            </div>
                            <a href="{{ route('google.login') }}" class="btn btn-light w-100 mb-3">

                                {{-- <i class="fab fa-google"></i> --}}
                                {{__('general.Continue_with')}}
                                <img src="https://upload.wikimedia.org/wikipedia/commons/2/2f/Google_2015_logo.svg"
                                    alt="Google G Logo" style="width: 50px; height: auto;">

                            </a>
                            <p class="text-center">{{__('general.Doesnt_have_an_Account?')}} <a href="/register"
                                    class="text-decoration-none">{{__('general.Register')}}</a></p>
                            @if (Route::has('password.request'))
                            <div class="text-center">

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('general.Forgot Your Password?') }}
                                </a>
                            </div>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


{{-- تضمين مكتبة CryptoJS --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<script>
     window.appConfig = {
        encryptionKey: "{{ config('app.encryption_key') }}"
    };
    document.addEventListener('alpine:init', () => {
        Alpine.data('loginForm', () => ({
            email: localStorage.getItem('rememberMe') === 'true' ? localStorage.getItem('email') || '' : '',
            password: localStorage.getItem('rememberMe') === 'true' ? decrypt(localStorage.getItem('password')) : '',
            remember: localStorage.getItem('rememberMe') === 'true',

            saveCredentials() {
                if (this.remember) {
                    localStorage.setItem('email', this.email);
                    localStorage.setItem('password', encrypt(this.password));
                    localStorage.setItem('rememberMe', 'true');
                } else {
                    localStorage.removeItem('email');
                    localStorage.removeItem('password');
                    localStorage.removeItem('rememberMe');
                }
            }
        }));

        // مفتاح التشفير - يجب أن يكون سرّيًا وقويًا

        const encryptionKey = window.appConfig.encryptionKey;
        // دالة التشفير
        function encrypt(data) {
            return CryptoJS.AES.encrypt(data, encryptionKey).toString();
        }

        // دالة فك التشفير
        function decrypt(ciphertext) {
            if (!ciphertext) return '';
            try {
                let bytes = CryptoJS.AES.decrypt(ciphertext, encryptionKey);
                return bytes.toString(CryptoJS.enc.Utf8);
            } catch (e) {
                return ''; // في حالة حدوث خطأ في فك التشفير
            }
        }
    });
</script>
@endsection
