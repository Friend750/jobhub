@php
    // نحسب عدد التعليقات الرئيسية فقط
    $commentsCount = $post->comments->whereNull('parent_id')->count();

    // نرتب التعليقات الرئيسية ونحدد العدد اللي يظهر
    $comments = $post->comments->whereNull('parent_id')->sortByDesc('created_at')->take($commentsToShow);
@endphp

@forelse ($comments as $comment)
    @php
        $commenter = $comment->user;
        $commenterName = $commenter->personal_details->first_name ?? 'مستخدم';
        $commenterLastName = $commenter->personal_details->last_name ?? '';
        $commenterSpecialist = $commenter->personal_details->specialist ?? null;
        $commenterImage = $commenter->user_image_url;
    @endphp

    <div class="comment mb-3" x-data="{ showReplyForm: false, showReplies: false }">
        {{-- User card --}}
        <div class="d-flex justify-content-between align-items-start">
            <a href="{{ route('user-profile', $commenter->user_name ?? '#') }}" class="text-decoration-none text-dark">
                <div class="d-flex align-items-center">
                    <img src="{{ $commenterImage }}" alt="{{ e($commenterName) }}" loading="lazy"
                        class="rounded-circle ms-2" style="width: 40px; height: 40px; object-fit: cover;">

                    <div class="d-flex flex-column gap-0">
                        <h6 class="mb-0">
                            {{ $commenterName }} {{ $commenterLastName }}
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

        <div style="margin-right: 40px">

            <small dir="auto" class="mt-2 me-2 mb-0 d-block CommentContent card">
                {!! highlightMentions($comment->content) !!}
                {{-- {{$comment->content}} --}}
            </small>


            <div class="ml-3 mt-1">
                <a class="btn btn-link text-decoration-none p-0 text-muted fw-bolder px-1"
                    style="font-size: 13px;">اعجبني</a>
                <span class="text-muted">|</span>
                <a href="javascript:void(0)" @click="showReplyForm = !showReplyForm"
                    class="btn btn-link text-decoration-none p-0 text-muted fw-bolder px-1"
                    style="font-size: 13px;">رد</a>

                @if ($comment->replies->count() > 0)
                    <span class="text-muted">|</span>
                    <a href="javascript:void(0)" @click="showReplies = !showReplies"
                        class="btn btn-link text-decoration-none p-0 text-muted fw-bolder px-1"
                        style="font-size: 13px;">
                        عرض {{ $comment->replies->count() }} ردود
                    </a>
                @endif

                <!-- Reply Form -->
                @include('livewire.includes.post-card.ReplyForm')
            </div>



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
