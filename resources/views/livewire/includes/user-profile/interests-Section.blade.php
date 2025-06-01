<div class="card mb-3 rounded">
    <div class="card-body">
        <h5 class="card-title">الاهتمامات</h5>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active text-dark" id="companies-tab" data-bs-toggle="tab" href="#companies"
                    role="tab" aria-controls="companies" aria-selected="true">الشركات</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link text-dark" id="connections-tab" data-bs-toggle="tab" href="#connections"
                    role="tab" aria-controls="connections" aria-selected="false">الاتصالات</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">

            <div class="tab-pane fade show active" id="companies" role="tabpanel" aria-labelledby="companies-tab">
                <div class="row mt-3">
                    @foreach ($topCompanies as $company)
                        <div class="col-md-6 mb-3">
                            <a href="{{ route('user-profile', $company->id) }}" class="text-decoration-none text-dark">
                                <div class="d-flex align-items-start justify-content-start gap-2">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($company->fullName()) }}"
                                        loading="lazy" class="rounded-circle" alt="{{ $company->fullName() }}"
                                        width="40" height="40">
                                    <div>
                                        <h6 class="mb-0">{{ $company->page_name ?? $company->fullName() }}</h6>
                                        <small
                                            class="text-muted">{{ number_format($company->accepted_all_followers_count) }}
                                            متابع</small>

                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach

                    <div class="text-center mt-3 position-relative">
                        <div class="border-top my-3" style="border-color: #d3d3d3; width: 100%;"></div>
                        <a href="{{ url('/FollowedList/' . $id . '/company') }}" class="text-decoration-none">
                            <strong class="text-dark">إظهار الكل</strong>
                        </a>
                    </div>
                </div>
            </div>


            <div class="tab-pane fade" id="connections" role="tabpanel" aria-labelledby="connections-tab">
                <div class="row mt-3">
                    @foreach ($topUsers as $user)
                        <div class="col-md-6 mb-3">
                            <a href="{{ route('user-profile', $user->id) }}" class="text-decoration-none text-dark">
                                <div class="d-flex align-items-start justify-content-start gap-2">
                                    <!-- Use the user's actual avatar if available, fallback to UI avatars -->
                                    <img src="{{ $user->user_image_url }}"
                                        loading="lazy" class="rounded-circle" alt="user profile"
                                        width="40" height="40">
                                    <div>
                                        <h6 class="mb-0">{{ $user->fullName() }}</h6>
                                        <div class="mt-1">
                                            <span class="badge bg-light text-dark border btn">
                                                {{ $user->accepted_all_followers_count }} متابع
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
                <div class="text-center mt-3 position-relative">
                    <div class="border-top my-3" style="border-color: #d3d3d3; width: 100%;"></div>
                    <a href="{{ url('/FollowedList/' . $id . '/user') }}" class="text-decoration-none"><strong
                            class="text-dark">إظهار الكل
                        </strong>
                    </a>
                </div>
            </div>
        </div>


    </div>
</div>

<style>
    .active{
        background: none !important;
        border-radius: 0 !important;
    }
</style>
