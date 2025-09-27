<div x-show="showReplyForm" x-transition class="mt-2">
    <form class="comment-form" wire:submit.prevent="createReplyComment({{ $comment->id }})">
        <div class="textarea-container d-flex align-items-center w-100">

            <input wire:model="commentForm.reply" type="text" class="form-control comment-input me-5"
                placeholder="اكتب ردك هنا...">

            <button type="submit" class="btn send-button"><i class="fa-solid fa-paper-plane"></i></button>

        </div>
    </form>
    @error('commentForm.reply')
        <div class="text-danger mt-1">
            <small>{{ $message }}</small>
        </div>
    @enderror
</div>

<div x-show="showReplies" x-transition>
    @foreach ($comment->replies as $reply)
    @php
        $replier = $reply->user;
        $replierName = $replier->personal_details->first_name ?? 'مستخدم';
        $replierLastName = $replier->personal_details->last_name ?? '';
        $replierSpecialist = $replier->personal_details->specialist ?? null;
        $replierImage = $replier->user_image_url;
    @endphp

        <div class="d-flex justify-content-between align-items-start my-2 mt-3">
        <a href="{{ route('user-profile', $replier->user_name ?? '#') }}" class="text-decoration-none text-dark">
            <div class="d-flex align-items-center">
                <img src="{{ $replierImage }}" alt="{{ e($replierName) }}" loading="lazy"
                     class="rounded-circle ms-2" style="width: 40px; height: 40px; object-fit: cover;">
                <div class="d-flex flex-column gap-0">
                    <h6 class="mb-0">{{ $replierName }} {{ $replierLastName }}</h6>
                    @if ($replierSpecialist)
                        <small class="fw-bold text-muted very-small-text">{{ $replierSpecialist }}</small>
                    @endif
                </div>
            </div>
        </a>
        <small class="text-muted">{{ $reply->created_at->diffForHumans() }}</small>
    </div>

    <div class="me-5 mt-1">
        <small dir="auto" class="mt-2 mb-0 d-block CommentContent card" style="white-space: unset;">
            {{ $reply->content }}
        </small>
    </div>

    @endforeach
</div>
