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
                    <a href="{{ route('user-profile', $commenter->user_name ?? '#') }}"
                        class="text-decoration-none text-dark">
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
                    <small dir="auto" class="mt-2 me-2 mb-0 d-block CommentContent card">{{ $comment->content }}</small>
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
                        <div x-show="showReplyForm" x-transition class="mt-2">
                            <form class="comment-form" wire:submit.prevent="createReplyComment({{ $comment->id }})">
                                <div class="textarea-container d-flex align-items-center w-100">

                                    <input wire:model="commentForm.reply" type="text"
                                        class="form-control comment-input me-5" placeholder="اكتب ردك هنا...">

                                    <button type="submit" class="btn send-button"><i
                                            class="fa-solid fa-paper-plane"></i></button>

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
                                <div class="d-flex align-items-start"
                                    style="
                                            background-color: aliceblue;
                                            padding: 16px;
                                            border-radius: 30px;
                                            margin: 8px 0;
                                            width: fit-content;
                                        ">
                                    <img src="{{ $reply->user->user_image_url }}"
                                        alt="{{ e($reply->user->personal_details->first_name) }}" loading="lazy"
                                        class="rounded-circle ms-3"
                                        style="width: 30px; height: 30px; object-fit: cover;">
                                    <div class="details">
                                        <h6 class="text-dark">
                                            {{ $reply->user->personal_details->first_name . ' ' . $reply->user->personal_details->last_name }}
                                        </h6>
                                        <p class="mb-0">
                                            {{ $reply->content }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
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
