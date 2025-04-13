@push('styles')
<link rel="stylesheet" href="{{ asset('css/jobList.css') }}">
<link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
<link rel="stylesheet" href="{{ asset('css/search.css') }}">
@endpush

<div class="container mt-4">
    <div class="row">
        <!-- قائمة الوظائف -->
        <div class="col-md-8">
            <h2 class="mb-4">الوظائف المتاحة</h2>

            <!-- أدوات الفرز والفلترة -->
            <div class="d-flex justify-content-between mb-3">
                <div>
                    <select wire:model="sortBy" class="form-select">
                        <option value="relevant">الأكثر صلة</option>
                        <option value="newest">الأحدث</option>
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

            <!-- قائمة الوظائف -->
            <div class="list-group shadow-sm">
                @foreach($jobs as $job)
                    <div class="list-group-item list-group-item-action d-flex gap-3 p-3 align-items-center">
                        <!-- صورة المستخدم -->
                        <img src="{{ asset('storage/' . ($job->user->image ?? 'default-avatar.png')) }}" 
                             alt="User Image" class="rounded-circle border" width="50" height="50">

                        <div class="w-100">
                            <h5 class="mb-1">
                                <a href="#" class="text-dark text-decoration-none">{{ $job->job_title }}</a>
                            </h5>
                            <p class="mb-1 text-muted d-flex align-items-center">
                                <img src="{{ asset('storage/' . ($job->user->image ?? 'default-avatar.png')) }}" 
                                     alt="User Image" class="rounded-circle me-2" width="20" height="20"> 
                                {{ $job->user->user_name ?? 'Unknown Company' }}
                            </p>
                            <small class="text-muted">
                                📍 {{ $job->job_location ?? 'Remote' }} • ⏳ {{ $job->created_at->diffForHumans() }}
                            </small>
                        </div>
                        <button class="btn btn-primary" wire:click="showDetails({{ $job->id }})">تفاصيل</button>
                    </div>
                @endforeach
            </div>

            <br>
            {{ $jobs->links('livewire::bootstrap') }}
        </div>

        <!-- تفاصيل الوظيفة -->
        <div class="col-md-4">
            @if($selectedJob)
                <div class="border rounded p-3 shadow-sm">
                    <div class="d-flex align-items-center mb-3">
                        <img src="{{ asset('storage/' . ($selectedJob->user->image ?? 'default-avatar.png')) }}" 
                             alt="User Image" class="rounded-circle border me-2" width="60" height="60">
                        <div>
                            <h5 class="mb-0">{{ $selectedJob->job_title }}</h5>
                            <p class="text-muted">{{ $selectedJob->user->user_name }}</p>
                        </div>
                    </div>

                    <p><strong>الشركة:</strong> {{ $selectedJob->user->user_name }}</p>
                    <p><strong>الموقع:</strong> {{ $selectedJob->job_location }}</p>
                    <p><strong>الوصف:</strong></p>
                    <p>{{ $selectedJob->about_job }}</p>
                    <p><strong>تاريخ النشر:</strong> {{ $selectedJob->created_at->diffForHumans() }}</p>

                    <a href="#" class="btn btn-primary">تقديم</a>
                    <button type="button" class="btn btn-secondary mt-2" wire:click="$set('selectedJob', null)">إغلاق</button>
                </div>
            @endif
        </div>
    </div>
</div>
