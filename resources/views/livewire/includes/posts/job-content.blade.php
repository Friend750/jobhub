{{-- Job Post Content Section --}}
<div class="job-post-section bg-white p-4 py-0 mb-0">
    <h3 class="job-title text-primary border-bottom pb-2 mb-3">
        <i class="bi bi-briefcase-fill"></i>
        {{ $post->job_title }}
    </h3>

    <div class="job-details">
        <div class="detail-item mb-3">
            <h5 class="detail-title fw-semibold text-dark">حول الوظيفة</h5>
            <p class="detail-content mb-0">{{ $post->about_job }}</p>
        </div>

        <div class="detail-item mb-3">
            <h5 class="detail-title fw-semibold text-dark">المهام الوظيفية</h5>
            <p class="detail-content mb-0">{{ $post->job_tasks }}</p>
        </div>

        @if ($post->job_conditions)
            <div class="detail-item">
                <h5 class="detail-title fw-semibold text-dark">متطلبات الوظيفة</h5>
                <p class="detail-content mb-0">{{ $post->job_conditions }}</p>
            </div>
        @endif
    </div>
</div>
<style>
    .job-post-section {
        border-right: 4px solid #2B6DAE;
    }

    .detail-title {
        font-size: 1.1rem;
    }

    .bg-light-blue {
        background-color: #f8f9fa;
    }
</style>
