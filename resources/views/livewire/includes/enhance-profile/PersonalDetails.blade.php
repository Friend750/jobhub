<section class="form-section mt-0 rounded">
    <h5 data-toggle="collapse" data-target="#personalDetails">
        <span>{{ __('general.personal_details') }}</span>
        <i class="fas fa-caret-down caret-icon"></i>
    </h5>
    <p>{{ __('general.form_description') }}</p>
    <div id="" class="collapse show">

        <div class="row mb-3">
            <div class="form-group col-md-6">
                <label class="mb-2" for="firstName">{{ __('general.first_name') }}</label>
                <input type="text"
                    class="form-control @error('PDFrom.firstName') is-invalid @enderror"
                    id="firstName"
                    wire:model.defer="PDFrom.firstName"
                    placeholder="{{ __('general.enter_first_name') }}">
                @error('PDFrom.firstName')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group col-md-6">
                <label class="mb-2" for="lastName">{{ __('general.last_name') }}</label>
                <input type="text"
                    class="form-control @error('PDFrom.lastName') is-invalid @enderror"
                    id="lastName"
                    wire:model.defer="PDFrom.lastName"
                    placeholder="{{ __('general.enter_last_name') }}">
                @error('PDFrom.lastName')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <div class="form-group col-md-6">
                <label class="mb-2" for="jobTitle">{{ __('general.specialization') }}</label>
                <input type="text"
                    class="form-control @error('PDFrom.jobTitle') is-invalid @enderror"
                    id="jobTitle"
                    wire:model.defer="PDFrom.jobTitle"
                    placeholder="{{ __('general.enter_specialization') }}">
                @error('PDFrom.jobTitle')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group col-md-6">
                <label class="mb-2" for="email">{{ __('general.email') }}</label>
                <input type="email"
                    class="form-control @error('PDFrom.email') is-invalid @enderror"
                    id="email"
                    wire:model.defer="PDFrom.email"
                    placeholder="{{ __('general.enter_email') }}">
                @error('PDFrom.email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <div class="form-group col-md-6">
                <label class="mb-2" for="phone">{{ __('general.phone') }}</label>
                <input type="text"
                    class="form-control @error('PDFrom.phone') is-invalid @enderror"
                    id="phone"
                    wire:model.defer="PDFrom.phone"
                    placeholder="{{ __('general.enter_phone') }}">
                @error('PDFrom.phone')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group col-md-6">
                <label class="mb-2" for="city">{{ __('general.city') }}</label>
                <input type="text"
                    class="form-control @error('PDFrom.city') is-invalid @enderror"
                    id="city"
                    wire:model.defer="PDFrom.city"
                    placeholder="{{ __('general.enter_city') }}">
                @error('PDFrom.city')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>

    </div>
</section>
