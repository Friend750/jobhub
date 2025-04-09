<div class="d-flex justify-content-between">
    <div>
        <?php
            if($post->type == 'job') {
                $likseCount = $post->likes()->where('type', 'job')->count();
            } else {
                $likseCount = $post->likes()->where('type', 'post')->count();
            }
        ?>
        @if (Auth::user()->likesPost($post))
            <button class="btn btn-light" data-bs-toggle="tooltip" title="إلغاء إعجاب"
                wire:click.prevent="unlikePost({{ $post->id }})">
                <i class="bi bi-hand-thumbs-up-fill"></i>
                @if ($likseCount > 0)
                    <span class="ms-2">
                        {{ $likseCount }}
                    </span>
                @endif
            </button>
        @else
            <button class="btn btn-light" data-bs-toggle="tooltip" title="إعجاب" wire:click.prevent="likePost({{ $post->id }})">
                <i class="bi bi-hand-thumbs-up"></i>
                @if ($likseCount > 0)
                    <span class="ms-2">
                        {{ $likseCount }}
                    </span>
                @endif
            </button>
        @endif

        <button class="btn btn-light" data-bs-toggle="tooltip" title="تعليق" x-on:click="showComments = !showComments">
            <i class="bi bi-chat"></i>
        </button>
    </div>
    <button class="btn btn-light" data-bs-toggle="tooltip" title="حفظ">
        <i class="bi bi-save"></i>
    </button>
</div>

