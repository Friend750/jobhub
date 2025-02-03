<div class="">
    <label for="password" class="col-form-label text-md-end">{{ __('general.Password') }}</label>

    <input wire:model.live.debounce.500ms="password" id="password" type="password"
        class="form-control @error('password') is-invalid @enderror @if($errorMessage) is-invalid @endif" name="password"
        autocomplete="new-password">

    @error('password')
        <span class="invalid-feedback" role="alert">
            <small>{{ $message }}</small>
        </span>
    @enderror

    @if($errorMessage)
    <span class="invalid-feedback" role="alert">
        <small>{{ $errorMessage }}</small>
    </span>
@endif
</div>