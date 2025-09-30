<div x-data="WatchAndLoadComments(@this)">

    <div class="comments mt-3" x-show="showComments" x-transition x-cloak>
        <div class="d-flex align-items-start mb-3">
            <form class="comment-form" wire:submit.prevent="createComment({{ $post->id }}, '{{ $post->type }}')">

                <div class="textarea-container d-flex align-items-center w-100">
                    <textarea name="CommentText" id="CommentContent"
                        class="form-control comment-input me-5
                        @error('commentForm.content') is-invalid @enderror"
                        wire:model.defer="commentForm.content" {{-- ربط مباشر بالـ Livewire --}}
                        required
                        placeholder="أضف تعليق...">
                    </textarea>

                    <button type="submit" class="btn send-button">
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

        @include('livewire.includes.post-card.AllComments')

    </div>

</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('WatchAndLoadComments', (wire) => ({
            init() {
                // إذا أردت تفاعل إضافي يمكن مراقبة commentForm.content عبر Alpine
                // مثلاً:
                // this.$watch('CommentContent', value => console.log(value));
            }
        }));
    });
</script>
