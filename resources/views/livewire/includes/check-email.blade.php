<div>
    <label for="email" class="col-form-label text-md-end">{{ __('general.Email_Address') }}</label>

    <input wire:model.live.debounce.500ms="email" id="email" type="email"
        class="form-control @error('email') is-invalid @enderror  @if($emailExists) is-invalid @endif" name="email" autocomplete="email">



@error('email')
    <span class="invalid-feedback" role="alert">
        <small>{{ $message }}</small>
    </span>
@enderror


    @if($emailExists)
    <span class="invalid-feedback" role="alert">
        <small>{{ $errorMessage }}</small>
    </span>
    @endif
</div>