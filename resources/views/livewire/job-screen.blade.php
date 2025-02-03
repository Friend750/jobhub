@push('styles')
<link rel="stylesheet" href="{{ asset('css/jobScreen.css') }}">
<link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
<link rel="stylesheet" href="{{ asset('css/search.css') }}">
@endpush

<div class="container mb-3" style="margin-top: 5.5rem !important;">
    <!-- Filters Section -->
    <div class="filters-section rounded">
        <div class="filters-container">
            <select class="filter" wire:model="sortBy">
                <option value="relevant">Most Relevant</option>
                <option value="newest">Newest</option>
            </select>
            <select class="filter" wire:model="timeFilter">
                <option value="">Any Time</option>
                <option value="24h">Last 24 Hours</option>
                <option value="week">Last Week</option>
            </select>
            <button class="filter-btn" wire:click="resetFilters">Reset Filters</button>
        </div>
    </div>

    <!-- Job Content -->
    <div class="job-content">
        <!-- Job Listings -->
        <div class="job-listings rounded">
            @foreach ($filteredJobs as $index => $job)
                <div class="job-listing-card {{ $selectedJob['id'] === $job['id'] ? 'active' : '' }}"
                    wire:click="selectJob({{ $job['id'] }})">
                    
                    <div class="d-flex align-items-center">
                        <!-- صورة الوظيفة مع إطار -->
                        <img src="{{ $job['photo'] ?? 'https://via.placeholder.com/50' }}" 
                             alt="Job Image" 
                             class="me-2 rounded-circle image-frame"
                             style="width: 50px; height: 50px; object-fit: cover;">
                        
                        <div class="d-flex flex-column flex-wrap flex-grow-1">
                            <h4>{{ $job['title'] }}</h4>
                            <p class="mb-0">{{ $job['company'] }} • {{ $job['location'] }}</p>
                            <small class="text-muted">{{ $job['time']->diffForHumans() }} • {{ $job['applicants'] }}</small>
                        </div>
                    </div>
                    <button type="button" class="apply-btn">More details</button>
                </div>
                @if ($index < count($filteredJobs) - 1)
                    <hr>
                @endif
            @endforeach
        </div>

        <!-- Job Details -->
        <div class="job-details make-sticky d-block rounded shadow-sm">
            @if ($selectedJob)
                <div>
                    <div class="d-flex justify-content-start align-items-center">
                        <!-- صورة صاحب الوظيفة أو الشركة مع إطار -->
                        <img src="{{ $selectedJob['photo'] ?? 'https://via.placeholder.com/70' }}" 
                             loading="lazy" 
                             alt="Profile Photo" 
                             class="me-2 rounded-circle image-frame"
                             style="width: 70px; height: 70px; object-fit: cover;">
                        
                        <div>
                            <h2 class="mb-0">{{ $selectedJob['title'] }}</h2>
                            <small><strong>{{ $selectedJob['company'] }}</strong> •
                                {{ $selectedJob['location'] }}</small>
                            <small class="text-muted">{{ $selectedJob['time']->diffForHumans() }}</small>
                        </div>
                    </div>
                    <div class="details mt-2">
                        <p>{{ $selectedJob['description'] }}</p>
                        <button type="button" class="apply-btn" onclick="alert('Application submitted!')">Apply Now</button>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- 🔹 تنسيق CSS لإضافة إطار حول الصور -->

