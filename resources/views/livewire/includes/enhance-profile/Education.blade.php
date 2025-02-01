<section class="form-section rounded">
    <h5 data-toggle="collapse" data-target="#education">
        {{ __('general.education') }}
        <div class="d-flex align-items-center">
            <button class="btn text-muted btn-sm me-3 trash-button" type="button"
                x-on:click="toggleSection('education')" title="{{ __('general.remove_section') }}">
                <i class="fas fa-trash"></i>
            </button>
            <i class="fas fa-caret-down caret-icon"></i>
        </div>
    </h5>
    <p>{{ __('general.education_description') }}</p>
    <div id="education" class="collapse show">
        @foreach ($EDForm->educations as $index => $education)
            <div class="form-row">
                <!-- Degree -->
                <div class="form-group col-md-4">
                    <label>{{ __('general.degree') }}</label>
                    <input type="text"
                        class="form-control @error("EDForm.educations.{$index}.degree") is-invalid @enderror"
                        wire:model="EDForm.educations.{{ $index }}.degree"
                        placeholder="{{ __('general.placeholder_degree') }}">
                    @error("EDForm.educations.{$index}.degree")
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Institution Name -->
                <div class="form-group col-md-4">
                    <label>{{ __('general.institution_name') }}</label>
                    <input type="text"
                        class="form-control @error("EDForm.educations.{$index}.institution_name") is-invalid @enderror"
                        wire:model="EDForm.educations.{{ $index }}.institution_name"
                        placeholder="{{ __('general.placeholder_institution') }}">
                    @error("EDForm.educations.{$index}.institution_name")
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Location -->
                <div class="form-group col-md-4">
                    <label>{{ __('general.location') }}</label>
                    <input type="text"
                        class="form-control @error("EDForm.educations.{$index}.location") is-invalid @enderror"
                        wire:model="EDForm.educations.{{ $index }}.location"
                        placeholder="{{ __('general.placeholder_location') }}">
                    @error("EDForm.educations.{$index}.location")
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Graduation Date -->
                <div class="form-group col-md-4">
                    <label>{{ __('general.graduation_date') }}</label>
                    <input type="date"
                        class="form-control @error("EDForm.educations.{$index}.graduation_date") is-invalid @enderror"
                        wire:model="EDForm.educations.{{ $index }}.graduation_date">
                    @error("EDForm.educations.{$index}.graduation_date")
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Certification Name -->
                <div class="form-group col-md-8">
                    <label>{{ __('general.certification_name') }}</label>
                    <input type="text"
                        class="form-control @error("EDForm.educations.{$index}.certification_name") is-invalid @enderror"
                        wire:model="EDForm.educations.{{ $index }}.certification_name"
                        placeholder="{{ __('general.placeholder_certification') }}">
                    @error("EDForm.educations.{$index}.certification_name")
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <!-- Description -->
            <div class="form-group flex-grow-1">
                <label>{{ __('general.description') }}</label>
                <div class="d-flex">
                    <textarea class="form-control @error("EDForm.educations.{$index}.description") is-invalid @enderror"
                        wire:model="EDForm.educations.{{ $index }}.description"
                        placeholder="{{ __('general.placeholder_description') }}" rows="3"></textarea>
                </div>
                @error("EDForm.educations.{$index}.description")
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        @endforeach
        <div class="d-flex justify-content-end align-items-center mt-0">
            <button type="button" class="btn btn-primary rounded" wire:click='addEducationRow'>
                {{ __('general.add_education') }}
            </button>
            @if ($index > 0)
                <button type="button" class="btn btn-primary rounded ms-2"
                    wire:click="removeEducationRow({{ $index }})">
                    <i class="bi bi-trash-fill m-0 p-0"></i>
                </button>
            @endif
        </div>
    </div>
</section>
