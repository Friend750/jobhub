<style>
    .CommentContent {
        white-space: pre-wrap;
        background-color: aliceblue;
        padding: 10px;
        border: none;
        width: fit-content;
    }
</style>
<div x-data="WatchAndLoadComments(@this)">

    <div class="comments mt-3" x-show="showComments" x-transition x-cloak>
        <div class="d-flex align-items-start mb-3" x-data="mentionSystem(@this, 'CommentContent')">
            <form class="comment-form" wire:submit.prevent="createComment({{ $post->id }}, '{{ $post->type }}')">

                <div class="textarea-container d-flex align-items-center w-100">

                    <textarea name="CommentText" id="CommentContent"
                        class="form-control comment-input me-5
                        @error('commentForm.content') is-invalid @enderror"
                        {{-- wire:model="commentForm.content" --}} x-model="CommentContent" x-on:input="handleInput($event)" required placeholder="أضف تعليق...">
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

                @include('livewire.includes.mention-system-logic', [
                    'CommentsOffsetX' => 50,
                    'CommentsOffsetY' => -200,
                ])

            </form>
        </div>

        @include('livewire.includes.post-card.AllComments')

    </div>

</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('WatchAndLoadComments', (wire) => ({

            init() {
                this.$watch('showComments', () => this.loadUsersToMention());
            },

            loadUsersToMention() {
                if (this.showComments) {
                    wire.loadUsersToMention();
                    // console.log('load users to mention');
                } else {
                    // console.log('unload users to mention');
                    wire.usersToMention = [];
                }
            }
        }));
    });
</script>
