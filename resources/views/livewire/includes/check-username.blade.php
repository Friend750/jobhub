<div>
    <label for="username" class="col-form-label text-md-end">{{ __('general.Username') }}</label>

    <input wire:model.live.debounce.500ms="username" id="username" type="text"
        class="form-control @if($usernameExists) is-invalid @endif @error('username') is-invalid @enderror"
        name="username" autofocus required>
    
        @error('username')
        <span class="invalid-feedback" role="alert">
            <small>{{ $message }}</small>
        </span>
    @enderror
    
    @if($usernameExists)
        <span class="invalid-feedback" role="alert">
            <small>{{ $errorMessage }}</small>
        </span>
    @endif
</div>
