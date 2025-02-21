<div class="container mt-4">
    <div class="row">
        <div class="col-md-8">
            <h2 class="mb-4">الوظائف المتاحة</h2>

            <!-- أدوات الفرز والفلترة -->
            <div class="d-flex justify-content-between mb-3">
                <div>
                    <select wire:model="sortBy" class="form-select">
                        <option value="relevant">الأكثر صلة</option>
                        <option value="latest">الأحدث</option>
                    </select>
                </div>
                <div>
                    <select wire:model="timeFilter" class="form-select">
                        <option value="">الكل</option>
                        <option value="24h">آخر 24 ساعة</option>
                        <option value="week">آخر أسبوع</option>
                    </select>
                </div>
            </div>

            <div class="list-group shadow-sm">
                @foreach($jobs as $job)
                    <div class="list-group-item list-group-item-action d-flex gap-3 p-3 align-items-center">
                        <div class="w-100">
                            <h5 class="mb-1">
                                <a href="#" class="text-dark text-decoration-none">{{ $job->job_title }}</a>
                            </h5>
                            <p class="mb-1 text-muted">{{ $job->user->user_name ?? 'Unknown Company' }}</p>
                            <small class="text-muted">
                                📍 {{ $job->job_location ?? 'Remote' }} • ⏳ {{ $job->created_at->diffForHumans() }}
                            </small>
                        </div>
                        <button class="btn btn-primary" wire:click="showDetails({{ $job->id }})">Details</button>
                    </div>
                @endforeach
            </div>
            <br>
                {{-- {{ $jobs->links() }} <!-- روابط الترقيم --> --}}
                {{ $jobs->links('livewire::bootstrap') }}

        </div>

        <!-- تفاصيل الوظيفة -->
        <div class="col-md-4">
            @if($selectedJob)
                <div class="border rounded p-3 shadow-sm">
                    <h5>{{ $selectedJob->job_title }}</h5>
                    <p><strong>Company:</strong> {{ $selectedJob->user->user_name }}</p>
                    <p><strong>Location:</strong> {{ $selectedJob->job_location }}</p>
                    <p><strong>Description:</strong></p>
                    <p>{{ $selectedJob->about_job }}</p>
                    <p><strong>Posted:</strong> {{ $selectedJob->created_at->diffForHumans() }}</p>
                    <a href="#" class="btn btn-primary">Apply</a>
                    <button type="button" class="btn btn-secondary mt-2" wire:click="$set('selectedJob', null)">Close</button>
                </div>
            @else
                {{-- <div class="border rounded p-3 text-center">
                    <p>Select a job to see the details.</p>
                </div> --}}
            @endif
        </div>
    </div>
</div>
