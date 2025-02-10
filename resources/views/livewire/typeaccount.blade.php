<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="row col-md-6">

        <div class="rounded p-3 bg-light shadow-sm">
            <h2>{{ __('general.account_type') }}</h2>
            <p>{{ __('general.account_type_description') }}</p>
            <hr>
            <div class="d-flex align-items-end justify-content-between">
                <div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="accountType" id="personal"
                            value="personal" wire:model="accountType">
                        <label class="form-check-label" for="personal">
                            {{ __('general.personal') }}
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="accountType" id="company" value="company"
                            wire:model="accountType">
                        <label class="form-check-label" for="company">
                            {{ __('general.company') }}
                        </label>
                    </div>
                </div>
                <div class="text-center">
                    <button wire:click="save" class="btn btn-primary rounded">
                        {{ __('general.next') }} <i class="bi bi-chevron-left"></i>
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>
