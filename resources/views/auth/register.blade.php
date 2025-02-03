@extends('layouts.app')

@section('Title', 'Register')


@section('content')
    <div class="d-flex align-items-center justify-content-center vh-100">

        <div class="container">
            <div class="row justify-content-center">
                <div class="card p-4 shadow-sm mt-1 col-md-4 col-sm-8">

                    <div class="card-body">
                        <h2 class="">{{ __('general.Register') }}</h2>
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                        
                            @livewire('includes.check-username')  {{-- مكون Livewire للتحقق من اسم المستخدم --}}
                        
                            @livewire('includes.check-email')


                            @livewire('includes.check-password')
                            

                        
                           
                        
                            <div class="mb-3">
                                <label for="password-confirm"
                                    class="col-form-label text-md-end">{{ __('general.Confirm Password') }}</label>
                        
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" autocomplete="new-password">
                            </div>
                        
                            <div class="row mb-0">
                                <div class="">
                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-primary w-100">
                                            {{ __('general.Register') }}
                                        </button>
                                    </div>
                                    <div class="text-center">
                                        <span>{{__('general.Already have an account?')}}</span>
                                        <a href="/login" class="text-decoration-none"> {{__('general.Login')}}</a>
                                    </div>
                                </div>
                            </div>                        
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
