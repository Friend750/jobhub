@push('styles')
<link rel="stylesheet" href="{{ asset('css/jobScreen.css') }}">
<link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
<link rel="stylesheet" href="{{ asset('css/search.css') }}">
@endpush

<div class="container mb-3" style="margin-top: 5.5rem !important;">
    <!-- Filters Section -->
    

    <!-- Job Content -->
    <div class="job-content">
        <!-- Job Listings -->
        <div class="job-listings rounded">
            <livewire:job-list />
        </div>
    </div>
</div>
