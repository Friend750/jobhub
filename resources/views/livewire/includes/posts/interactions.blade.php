<div class="d-flex justify-content-between">
    <div>
        @php
            $liked = Auth::user()->likesPost($post) || Auth::user()->likesJobPost($post);
            $likesCount = $this->getLikesCount($post->id, $post->type);
        @endphp

        <button class="btn btn-light" data-bs-toggle="tooltip" title="{{ $liked ? 'إلغاء إعجاب' : 'إعجاب' }}"
            wire:click="{{ $liked ? 'unlikeItem' : 'likeItem' }}({{ $post->id }}, '{{ $post->type }}')">
            <i class="bi bi-hand-thumbs-up{{ $liked ? '-fill' : '' }}"></i>
            @if($likesCount > 0)
                <span class="ms-2">{{ $likesCount }}</span>
            @endif
        </button>

        <button class="btn btn-light" data-bs-toggle="tooltip" title="تعليق" x-on:click="showComments = !showComments">
            <i class="bi bi-chat"></i>
        </button>
    </div>
    {{-- <button class="btn btn-light" data-bs-toggle="tooltip" title="حفظ">
        <i class="bi bi-save"></i>
    </button> --}}
</div>

