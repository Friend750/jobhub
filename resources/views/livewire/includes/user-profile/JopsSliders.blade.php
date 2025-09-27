<div class="tab-pane fade" id="jobs" role="tabpanel" aria-labelledby="jobs-tab">
    <div class="mt-3">
        <div class="row">
            @forelse ($jobs as $job)
                <div class="col-md-6 mb-3" wire:key="job-{{ $job->id }}">
                    <div class="job-card card border-0 shadow-sm hover-shadow transition h-100">
                        <div class="card-body p-3 d-flex flex-column">
                            <div class="d-flex flex-column flex-grow-1">
                                <h5 class="card-title mb-2 fw-semibold">{{ $job->job_title }}</h5>
                                <p class="card-text text-muted small mb-2 line-clamp-2 flex-grow-0">
                                    {{ $job->about_job }}
                                </p>
                                <div class="d-flex gap-2 mb-2">
                                    <span
                                        class="badge bg-light text-dark border small text-wrap lh-base">{{ $job->job_timing ?? 'null' }}</span>
                                    <span
                                        class="badge bg-light text-dark border small text-wrap lh-base">{{ $job->job_location ?? 'null' }}</span>
                                </div>
                            </div>
                            <div class="mt-auto" style="width: fit-content">
                                <a href="{{ Route('jobList', $job->id) }}"
                                    class="btn color-bg-blue-light text-primary fw-bold d-flex align-items-center gap-1">
                                    <span>معرفة التفاصيل</span>
                                    <i class="fa-solid fa-square-arrow-up-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p class="py-3 text-center">
                        <span class="text-muted">لا توجد وظائف متاحة حاليا</span>
                    </p>
                </div>
            @endforelse
        </div>

        @if ($jobs->count() > 1)
            <div class="text-center mt-3 position-relative">
                <div class="border-top my-3" style="border-color: #d3d3d3; width: 100%;"></div>
                <a href="{{route('ShowAllJobs', $user->id)}}" class="text-decoration-none">
                    <strong class="text-dark">إظهار الكل</strong>
                    <strong class="text-dark">
                        (
                        {{ $jobs->count() }}
                        )
                    </strong>
                </a>
            </div>
        @endif
    </div>
</div>

<style>
    .job-card {
        min-height: 200px;
        border: 1px solid #e0e0e0 !important;
        transition: all 0.3s ease;
    }

    .job-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }

    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .color-bg-blue-light {
        background-color: #e3f2fd;
    }

    .color-bg-blue-light:hover {
        background-color: #bbdefb;
    }
</style>
