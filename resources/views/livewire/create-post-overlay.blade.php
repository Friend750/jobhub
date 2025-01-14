<div>


    <!-- Overlay -->
    <div class="overlay @if ($showCard) d-flex @else d-none @endif ">
        <div class="card post-card">

            <div class="card-header d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center ">
                    <img src="https://via.placeholder.com/50" alt="User" loading="lazy" class="rounded-circle me-3 h-100">
                    <div>
                        <h5 class="mb-0">Elon Musk</h5>
                        <div class="dropdown">
                            <button class="btn btn-light btn-sm dropdown-toggle py-0" type="button"
                                id="postAudienceDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                Post to anyone
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="postAudienceDropdown">
                                <li><a class="dropdown-item" href="#">Post to anyone</a></li>
                                <li><a class="dropdown-item" href="#">Connections only</a></li>
                                <li><a class="dropdown-item" href="#">Specific group</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn-close" wire:click="$set('showCard', false)"
                    aria-label="Close"></button>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <textarea class="form-control w-100" id="postContent" rows="6" placeholder="What do you want to talk about?"
                        wire:model="content"></textarea>
                    @error('content')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Media Preview -->
                @if ($mediaPreview)
                    <!-- Single Image -->
                    <div class="mt-3">
                        <div class="image-container">
                            <img src="{{ $mediaPreview }}" loading="lazy" alt="Image Preview" class="post-image">
                        </div>
                    </div>
                @endif

            </div>
            <div class="card-footer d-flex justify-content-between">
                <div>
                    <label for="fileInput" class="btn btn-light m-0">
                        Add media
                        <i class="bi bi-image"></i>
                    </label>
                    <input type="file" id="fileInput" accept="image/*" class="d-none" wire:model="media">
                    @error('media')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <button class="btn btn-primary" wire:click='submit'>Post</button>
            </div>
        </div>
    </div>
</div>
