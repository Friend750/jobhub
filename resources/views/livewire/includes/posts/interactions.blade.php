<div class="d-flex justify-content-between" x-data="{
    isLiked: @json($this->isExisting($post->id)),
    likesCount: {{ $post->type === 'post' ? $post->likes()->count() : 0 }},
    toggleLike() {
        this.isLiked = !this.isLiked;
        this.likesCount += this.isLiked ? 1 : -1;
        @this.toggleLike({{ $post->id }});
    }
}">
    <div>
        <button @click="toggleLike()"
                class="btn btn-light"
                :class="{ 'text-primary': isLiked }"
                data-bs-toggle="tooltip"
                title="إعجاب"
                wire:ignore>
            <i class="bi" :class="isLiked ? 'bi-hand-thumbs-up-fill' : 'bi-hand-thumbs-up'"></i>
            <span class="ms-1" x-text="likesCount"></span>
        </button>

        <button class="btn btn-light" data-bs-toggle="tooltip" title="تعليق" @click="showComments = !showComments">
            <i class="bi bi-chat"></i>
        </button>
    </div>
    <button class="btn btn-light" data-bs-toggle="tooltip" title="حفظ">
        <i class="bi bi-save"></i>
    </button>
</div>
