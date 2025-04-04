<div class="d-flex justify-content-between">
    <div>
        <button wire:click='toggleLike({{ $post->id }}, "{{ $post->type }}")' class="btn btn-light"
            data-bs-toggle="tooltip" title="إعجاب">
            <i class="bi bi-hand-thumbs-up"></i>
        </button>
        <button class="btn btn-light" data-bs-toggle="tooltip" title="تعليق" @click="showComments = !showComments">
            <i class="bi bi-chat"></i>
        </button>
    </div>
    <button class="btn btn-light" data-bs-toggle="tooltip" title="حفظ">
        <i class="bi bi-save"></i>
    </button>
</div>
