@push('styles')
<link rel="stylesheet" href="{{ asset('css/homePage.css') }}">
<link rel="stylesheet" href="{{ asset('css/homePageNav.css') }}">
@endpush
<div>
    <div wire:loading wire:loading.target="loadData" style="width: 100%;">
        <div class="d-flex justify-content-center align-items-center vh-100 bg-white">
            <div class="d-flex flex-column align-items-center">
                <h1 class="logoName mb-2"> {{ __('general.logo') }}</h1>
                <span class="loader"></span>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div wire:init="loadData">
        <div style="width: 100%;" wire:loading.remove>
            @include('livewire.includes.home-page.home-page-sections')
        </div>
    </div>
</div>
