<form wire:submit.prevent="SubmitArticleForm">

    {{-- محتوى المقال --}}
    <div class="form-group mb-3">
        <textarea
            class="form-control w-100 @error('articleForm.content') is-invalid @enderror"
            id="postContent"
            rows="6"
            placeholder="ماذا تريد أن تتحدث عنه؟"
            wire:model.defer="articleForm.content">
        </textarea>

        @error('articleForm.content')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    {{-- Spinner عند رفع الوسائط --}}
    <div wire:loading wire:target="media" class="text-center my-3">
        <div class="spinner-border" role="status">
            <span class="visually-hidden">جار التحميل...</span>
        </div>
    </div>

    {{-- Media Preview --}}
    @if ($articleForm->mediaPreview)
        <div id="media-preview-wrapper" class="my-2 position-relative">
            <img src="{{ $articleForm->mediaPreview }}" alt="Image Preview" class="post-image rounded w-100">
            <button
                type="button"
                wire:click="removeMedia"
                aria-label="Close"
                class="btn-close bg-light position-absolute end-0 top-0 mt-2 me-2">
            </button>
        </div>
    @endif

    @error('articleForm.media')
        <div class="my-3">
            <small class="text-danger">{{ $message }}</small>
        </div>
    @enderror

    {{-- أزرار رفع الملف ونشر المقال --}}
    <div class="d-flex justify-content-end align-items-center gap-2 mt-3">
        <label for="fileInput" class="btn color-bg-blue-light rounded m-0 me-2">
            <i class="bi bi-image"></i>
            <input type="file" id="fileInput" accept="image/*" class="d-none" wire:model="media">
        </label>

        <button class="btn btn-primary rounded" wire:loading.attr="disabled">
            نشر المقال
        </button>
    </div>

</form>
