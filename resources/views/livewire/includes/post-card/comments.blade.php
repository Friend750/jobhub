<div class="comments mt-3" x-show="showComments" x-transition x-cloak>
    <div class="d-flex align-items-start mb-3">
        <form class="comment-form" wire:submit.prevent="createComment({{ $post->id }}, '{{ $post->type }}')">
            <div class="textarea-container">
                <textarea class="form-control comment-input comment-area" wire:model='commentForm.content' rows="1"
                    placeholder="أضف تعليق..."
                    oninput="this.style.height = ''; this.style.height = Math.min(this.scrollHeight, parseInt(getComputedStyle(this).lineHeight) * 6) + 'px';"></textarea>
                <button class="btn send-button">
                    <i class="fa-solid fa-paper-plane"></i>
                </button>
            </div>
            @error('commentForm.content')
                <div class="text-danger mt-1">
                    <small>{{ $message }}</small>
                </div>
            @enderror
        </form>
    </div>


    @forelse ($post->comments->sortByDesc('created_at') ?? [] as $comment)
        @php
            $commenter = $comment->user;
            $commenterName = $commenter->personal_details->first_name ?? 'مستخدم';
            $commenterLastName = $commenter->personal_details->last_name ?? 'مستخدم';
            $commenterSpecialist = $commenter->personal_details->specialist ?? null;
            $commenterImage = $commenter->user_image_url;
        @endphp

        <div class="comment mb-3">
            <div class="d-flex justify-content-between align-items-start">
                <a href="{{ route('user-profile', $commenter->user_name ?? '#') }}" class="text-decoration-none text-dark">
                    <div class="d-flex align-items-center">
                        <img src="{{ $commenterImage }}" alt="{{ $commenterName }}" loading="lazy"
                            class="rounded-circle ms-2" style="width: 40px; height: 40px; object-fit: cover;">

                        <div class="d-flex flex-column gap-0">
                            <h5 class="mb-0">
                                {{ $commenterName }} {{ $commenterLastName }}
                                @if($post->trashed())
                                    <span class="badge bg-secondary">منشور محذوف</span>
                                @endif
                            </h5>
                            @if($commenterSpecialist)
                                <small class="fw-bold text-muted">{{ $commenterSpecialist }}</small>
                            @endif
                        </div>
                    </div>
                </a>
                <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
            </div>

            <div style="margin-right: 40px" >
                <small class="mt-2 me-2 mb-0 d-block">
                    {{ $comment->content }}
                </small>
                <div class="ml-3 mt-1">
                    <a class="btn btn-link text-decoration-none p-0 text-muted fw-bolder px-1"
                        style="font-size: 13px;">اعجبني</a>
                    <span class="text-muted">|</span>
                    <a class="btn btn-link text-decoration-none p-0 text-muted fw-bolder px-1 disabled"
                        style="font-size: 13px;">رد (قريبا)</a>
                </div>
            </div>
        </div>
    @empty
        <div class="text-center my-4 py-2">
            <h5 class="text-muted">لا توجد تعليقات بعد</h5>
            <p class="text-muted small">كن أول من يعلق على هذا المنشور!</p>
        </div>
    @endforelse


    <div class="text-center">
        <button type="button" class="btn btn-link text-decoration-none mt-3"><small class="text-muted">تحميل المزيد من
                التعليقات</small></button>
    </div>
</div>
