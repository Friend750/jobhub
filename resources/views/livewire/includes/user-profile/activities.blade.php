<div class="card mb-3 rounded">
    <div class="card-body">
        <h5 class="card-title mb-3">المنشورات</h5>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active text-dark" id="articles-tab" data-bs-toggle="tab" href="#articles"
                    role="tab" aria-controls="articles" aria-selected="true">مقالات</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link text-dark" id="jobs-tab" data-bs-toggle="tab" href="#jobs" role="tab"
                    aria-controls="jobs" aria-selected="false">وظائف</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">

            <div class="tab-pane fade show active" id="articles" role="tabpanel" aria-labelledby="articles-tab">
                <div class="d-flex flex-wrap mt-3">

                    @forelse ($articles as $article)
                        <div class="col-6 p-2">
                            <div class="card border">
                                <div class="card-body">

                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-flex align-items-start">
                                            <img src="{{ $user->user_image_url }}" alt="Profile Picture"
                                                class="rounded-circle ms-2 post-img" height="40" width="40">

                                            <div class="d-flex flex-column gap-0"
                                                style="
                                            font-size: x-small;
                                            ">
                                                <h6 class="mb-0">{{ $user->fullName() }}
                                                </h6>
                                                <small
                                                    class="fw-bold text-muted very-small-text">{{ $user->personal_details->specialist ?? '' }}</small>


                                            </div>
                                        </div>

                                        <small
                                            class="very-small-text d-flex align-items-center gap-1">{{ $article->created_at->diffForHumans() }}
                                            @if ($article->target === 'to_any_one')
                                                •
                                                <i class="fa-solid fa-earth-americas"></i>
                                            @endif

                                        </small>
                                    </div>

                                    <div dir="auto">
                                        <p class="card-text" style="font-size: small; white-space: pre-line;">
                                            {{ $article->content }}
                                        </p>
                                    </div>

                                    <script>
                                        document.addEventListener('DOMContentLoaded', function() {
                                            document.querySelectorAll('.card-text').forEach(el => {
                                                // Check if text overflows 3 lines
                                                const lineHeight = parseInt(getComputedStyle(el).lineHeight);
                                                if (el.scrollHeight > lineHeight * 3) {
                                                    el.classList.add('truncate-overflow'); // Apply CSS clamp
                                                }
                                            });
                                        });
                                    </script>

                                </div>
                            </div>

                        </div>
                    @empty

                        <p class="py-3 text-center">
                            <span class="text-muted">لا توجد مقالات متاحة حاليا</span>
                        </p>
                    @endforelse



                </div>
                <div class="text-center mt-3 position-relative">
                    <div class="border-top my-3" style="border-color: #d3d3d3; width: 100%;"></div>
                    <a href="#" class="text-decoration-none">
                        <strong class="text-dark">إظهار الكل</strong>
                    </a>
                </div>
            </div>


            <div class="tab-pane fade" id="jobs" role="tabpanel" aria-labelledby="jobs-tab">
                <div class="mt-3">

                    @forelse ($jobs as $job)
                        <div class="job-card card mb-3 border-0 shadow-sm hover-shadow transition">
                            <div class="card-body p-3">
                                <div class="row g-0 align-items-center">

                                    <div class="col ps-3 pe-2 py-2">
                                        <h5 class="card-title mb-1 fw-semibold">{{ $job->job_title }}</h5>
                                        <p class="card-text text-muted small mb-2 line-clamp-2">
                                            {{ $job->about_job }}
                                        </p>
                                        <div class="d-flex gap-2 flex-wrap">
                                            <span
                                                class="badge bg-light text-dark border small">{{ $job->job_timing ?? 'null'}}</span>
                                            <span class="badge bg-light text-dark border small">{{ $job->job_location ?? 'null'}}</span>
                                        </div>
                                    </div>

                                    <div class="col-auto">
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
                        <p class="py-3 text-center">
                            <span class="text-muted">لا توجد وظائف متاحة حاليا</span>
                        </p>
                    @endforelse



                    <div class="text-center mt-3 position-relative">
                        <div class="border-top my-3" style="border-color: #d3d3d3; width: 100%;"></div>
                        <a href="#" class="text-decoration-none">
                            <strong class="text-dark">إظهار الكل</strong>
                        </a>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>

<style>
    .active {
        background: none !important;
        border-radius: 0 !important;
        transition: .3s ease !important;
    }

    .truncate-overflow {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        /* Limit to 3 lines */
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    /* Custom Styles */
    .job-card {
        border-radius: 12px !important;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .job-card.hover-shadow:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1) !important;
    }

    .color-bg-blue-light {
        background-color: #f0f8ff;
        /* Very light blue */
    }

    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
