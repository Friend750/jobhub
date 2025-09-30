@php
    $commentsCount = $post->comments->whereNull('parent_id')->count();

    $comments = $post
        ->comments()
        ->with([
            'user.personal_details:id,user_id,first_name,last_name,specialist',
            'replies.user.personal_details:id,user_id,first_name,last_name,specialist'
        ])
        ->whereNull('parent_id')
        ->orderBy('created_at', 'desc')
        ->take($commentsToShow)
        ->get();
@endphp

@forelse ($comments as $comment)
    @php
        $commenter = $comment->user;
        $commenterFullName = trim(($commenter->personal_details->first_name ?? '') . ' ' . ($commenter->personal_details->last_name ?? ''));
        $commenterSpecialist = $commenter->personal_details->specialist ?? null;
        $commenterImage = $commenter->user_image_url;
    @endphp

    <div class="comment mb-3" x-data="{ showReplyForm: false, showReplies: false }">
        {{-- User Card --}}
        <div class="d-flex justify-content-between align-items-start">
            <a href="{{ route('user-profile', $commenter->user_name ?? '#') }}" class="text-decoration-none text-dark">
                <div class="d-flex align-items-center">
                    <img src="{{ $commenterImage }}" alt="{{ e($commenterFullName) }}" loading="lazy"
                        class="rounded-circle ms-2" width="40" height="40" style="object-fit: cover;">

                    <div class="d-flex flex-column gap-0">
                        <h6 class="mb-0">
                            {{ $commenterFullName ?: 'مستخدم' }}
                            @if ($post->trashed())
                                <span class="badge bg-secondary">منشور محذوف</span>
                            @endif
                        </h6>
                        @if ($commenterSpecialist)
                            <small class="fw-bold text-muted very-small-text">{{ $commenterSpecialist }}</small>
                        @endif
                    </div>
                </div>
            </a>
            <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
        </div>

        <div class="ms-5 mt-2">
            {{-- Comment Content --}}
            <small dir="auto" class="d-block CommentContent card p-2 mb-2">
                {{ $comment->content }}
            </small>

            {{-- Actions --}}
            <div class="d-flex gap-2">
                <a href="javascript:void(0)" class="btn btn-link text-decoration-none p-0 text-muted fw-bolder small">اعجبني</a>

                <a href="javascript:void(0)" @click="showReplyForm = !showReplyForm"
                    class="btn btn-link text-decoration-none p-0 text-muted fw-bolder small">رد</a>

                @if ($comment->replies->count() > 0)
                    <a href="javascript:void(0)" @click="showReplies = !showReplies"
                        class="btn btn-link text-decoration-none p-0 text-muted fw-bolder small">
                        عرض {{ $comment->replies->count() }} ردود
                    </a>
                @endif
            </div>

            {{-- Reply Form --}}
            @include('livewire.includes.post-card.ReplyForm')
        </div>
    </div>
@empty
    <div class="text-center my-4 py-2">
        <h5 class="text-muted">لا توجد تعليقات بعد</h5>
        <p class="text-muted small">كن أول من يعلق على هذا المنشور!</p>
    </div>
@endforelse

@if ($commentsCount > $commentsToShow)
    <div class="text-center">
        <button type="button" wire:click="loadMoreComments" class="btn btn-link text-decoration-none mt-3">
            <small class="text-muted">تحميل المزيد من التعليقات</small>
        </button>
    </div>
@endif
