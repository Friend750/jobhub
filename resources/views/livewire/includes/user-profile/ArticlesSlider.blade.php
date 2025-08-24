<div class="tab-pane fade show active" id="articles" role="tabpanel" aria-labelledby="articles-tab">
    <div class="row mt-3">
        @forelse ($articles as $article)
            <div class="col-md-6 mb-3">
                <div class="card border h-100 article-card">
                    <div class="card-body d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div class="d-flex align-items-start">
                                <img src="{{ $user->user_image_url }}" alt="Profile Picture"
                                    class="rounded-circle ms-2 post-img" style="object-fit: cover;" height="40"
                                    width="40">
                                <div class="d-flex flex-column">
                                    <h6 class="mb-0">{{ $user->fullName() }}</h6>
                                    <small
                                        class="fw-bold text-muted">{{ $user->personal_details->specialist ?? '' }}</small>
                                </div>
                            </div>
                            <small class="d-flex align-items-center gap-1">
                                {{ $article->created_at->diffForHumans() }}
                                @if ($article->target === 'to_any_one')
                                    •
                                    <i class="fa-solid fa-earth-americas"></i>
                                @endif
                            </small>
                        </div>

                        <div dir="auto" class="flex-grow-1">
                            <p class="card-text line-clamp-3" style="font-size: small; white-space: pre-line;">
                                {{ $article->content }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <p class="py-3 text-center">
                    <span class="text-muted">لا توجد مقالات متاحة حاليا</span>
                </p>
            </div>
        @endforelse
    </div>

    <div class="text-center mt-3 position-relative">
        <div class="border-top my-3" style="border-color: #d3d3d3; width: 100%;"></div>
        <a href="#" class="text-decoration-none">
            <strong class="text-dark">إظهار الكل</strong>
            {{-- the number of posts --}}
            <strong class="text-dark">
                (
                {{ $articles->count() }}
                )
            </strong>
        </a>
    </div>
</div>

<style>
    .article-card {
        min-height: 200px;
        border: 1px solid #e0e0e0 !important;
        transition: all 0.3s ease;
    }

    .article-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        cursor: pointer;
    }

    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .post-img {
        object-fit: cover;
    }
</style>
