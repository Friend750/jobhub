<form wire:submit.prevent="SubmitArticleForm">

    <div class="form-group">
        <textarea class="form-control w-100 @error('articleForm.content') is-invalid
                @enderror" id="postContent"
            rows="6" placeholder="What do you want to talk about?" wire:model="articleForm.content"></textarea>
        @error('articleForm.content')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    {{-- spinner --}}
    <div class="text-center m-auto mt-3 w-100" wire:loading wire:target="articleForm.media">
        <div class="spinner-border" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

    <!-- Media Preview -->
    @if ($articleForm->mediaPreview)
        <!-- Single Image -->
        <div class="my-3">
            <div class="rounded">
                <img src="{{ $articleForm->mediaPreview }}" alt="Image Preview" class="post-image rounded">
            </div>
        </div>
    @endif

    @error('articleForm.media')
        <div class="my-3">
            <small class="alert-danger p-2 rounded">{{ $message }}</small>
        </div>
    @enderror

    <div class="d-flex justify-content-end align-items-center">
        <label for="fileInput" class="btn color-bg-blue-light rounded m-0 me-2">
            <i class="bi bi-image"></i>
            <input type="file" id="fileInput" accept="image/*" class="d-none" wire:model="articleForm.media">
        </label>

        <button class="btn btn-primary rounded" wire:loading.attr="disabled" style="height: fit-content;">
            <span>Post Article</span>
        </button>
    </div>

</form>
