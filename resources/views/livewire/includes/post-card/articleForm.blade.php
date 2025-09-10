<form wire:submit.prevent="SubmitArticleForm">

    <div class="form-group" x-data="mentionSystem()">
        <textarea class="form-control w-100 @error('articleForm.content') is-invalid @enderror" id="postContent" rows="6"
            placeholder="ماذا تريد أن تتحدث عنه؟" wire:model="articleForm.content" x-model="content"
            x-on:input="handleInput($event)">
        </textarea>

        @error('articleForm.content')
            <small class="text-danger">{{ $message }}</small>
        @enderror

        @include('livewire.includes.mention-system-logic')
    </div>

    {{-- spinner --}}
    <div class="text-center m-auto mt-3 w-100" wire:loading wire:target="media">
        <div class="spinner-border" role="status">
            <span class="visually-hidden">جار التحميل...</span>
        </div>
    </div>

    <!-- Media Preview -->
    @if ($articleForm->mediaPreview)
        <!-- Single Image -->
        <div class="my-2">
            <div class="position-relative">
                <img src="{{ $articleForm->mediaPreview }}" alt="Image Preview" class="post-image rounded w-100 ">
                <button type="button" wire:click="removeMedia" aria-label="Close"
                    class="btn-close bg-light position-absolute end-0 top-0 mt-2 me-2">
                </button>
            </div>
        </div>
    @endif

    @error('articleForm.media')
        <div class="my-3">
            <small class="text-danger">{{ $message }}</small>
        </div>
    @enderror

    <div class="d-flex justify-content-end align-items-center gap-2">

        <label for="fileInput" class="btn color-bg-blue-light rounded m-0 me-2">
            <i class="bi bi-image"></i>
            <input type="file" id="fileInput" accept="image/*" class="d-none" wire:model="media">
        </label>

        <button class="btn btn-primary rounded" wire:loading.attr="disabled" style="height: fit-content;">
            <span>نشر المقال</span>
        </button>
    </div>

</form>

