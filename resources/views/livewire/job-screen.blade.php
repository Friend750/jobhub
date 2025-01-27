@push('styles')
<link rel="stylesheet" href="{{ asset('css/jobScreen.css') }}">
<link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
<link rel="stylesheet" href="{{ asset('css/search.css') }}">
@endpush
<div class="container mb-3" style="margin-top: 5.5rem !important;">
    <!-- Filters Section -->
    <div class="filters-section  rounded">
        <div class="filters-container">
            <select class="filter">
                <option>Most Relevant</option>
                <option>Newest</option>
            </select>
            <select class="filter">
                <option>Any Time</option>
                <option>Last 24 Hours</option>
                <option>Last Week</option>
            </select>
            <select class="filter">
                <option>25 Miles (40 km)</option>
                <option>10 Miles (16 km)</option>
                <option>50 Miles (80 km)</option>
            </select>
            <button class="filter-btn">More Options</button>
        </div>
    </div>

    <!-- Job Content -->
    <div class="job-content">
        <!-- Job Listings -->
        <div class="job-listings rounded">
            @foreach ($jobs as $index => $job)
                <div class="job-listing-card {{ $selectedJob['id'] === $job['id'] ? 'active' : '' }}"
                    wire:click="selectJob({{ $job['id'] }})">
                    <div class="d-flex flex-column flex-wrap flex-grow-1">
                        <h4>{{ $job['title'] }}</h4>
                        <p class="mb-0">{{ $job['company'] }} • {{ $job['location'] }}</p>
                        <small class="text-muted">{{ $job['time'] }} • {{ $job['applicants'] }}</small>
                    </div>
                    <button type="button" class="apply-btn">More details</button>
                </div>
                @if ($index < count($jobs) - 1)
                    <hr>
                @endif
            @endforeach
        </div>

        <!-- Job Details -->
        <div class="job-details make-sticky d-block rounded shadow-sm">
            @if ($selectedJob)
                <div>
                    <div class="d-flex justify-content-start align-items-center">
                        <img src="{{ $job['photo'] }}" loading="lazy" alt="Profile Photo" class="me-2 rounded-circle">
                        <div>
                            <h2 class="mb-0">{{ $selectedJob['title'] }}</h2>
                            <small><strong>{{ $selectedJob['company'] }}</strong> •
                                {{ $selectedJob['location'] }}</small>
                            <small class="text-muted">{{ $selectedJob['time'] }}</small>


                        </div>
                    </div>
                    <div class="details mt-2">

                        <p>{{ $selectedJob['description'] }}</p>
                        <button type="button" class="apply-btn" onclick="alert('Application submitted!')">Apply
                            Now</button>
                    </div>
                </div>
            @else
                <h2>Select a job to view details</h2>
                <p>Job details will appear here when you click on a job listing.</p>
            @endif
        </div>
    </div>
</div>
