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
        {{-- Reply card --}}
        <div class="d-flex justify-content-between align-items-start my-2 mt-3">
            <a href="{{ route('user-profile', $reply->user->user_name ?? '#') }}"
                class="text-decoration-none text-dark">
                <div class="d-flex align-items-center">
                    {{-- User Image --}}
                    <img src="{{ $reply->user->user_image_url }}"
                        alt="{{ e($reply->user->personal_details->first_name) }}" loading="lazy"
                        class="rounded-circle ms-2" style="width: 40px; height: 40px; object-fit: cover;">

                    {{-- User Name and Specialty --}}
                    <div class="d-flex flex-column gap-0">
                        <h6 class="mb-0">
                            {{ $reply->user->personal_details->first_name . ' ' . $reply->user->personal_details->last_name }}
                        </h6>
                        @if (!empty($reply->user->personal_details->specialist))
                            <small class="fw-bold text-muted very-small-text">
                                {{ $reply->user->personal_details->specialist }}
                            </small>
                        @endif
                    </div>
                </div>
            </a>

            {{-- Timestamp --}}
            <small class="text-muted">{{ $reply->created_at->diffForHumans() }}</small>
        </div>

        {{-- Reply Content --}}
        <div class="me-5 mt-1">
            {{-- <p class="mb-0 text-secondary" style="width: fit-content;">
                {{ $reply->content }}
            </p> --}}
            <small dir="auto" class="mt-2 mb-0 d-block CommentContent card">{{ $reply->content }}</small>
        </div>
    @endforeach
</div>
