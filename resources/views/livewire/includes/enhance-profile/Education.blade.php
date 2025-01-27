<section class="form-section rounded">
    <h5 data-toggle="collapse" data-target="#education">
        Education
        <div class="d-flex align-items-center">
            <button class="btn text-muted btn-sm me-3 trash-button" type="button" x-on:click="toggleSection('education')"
                title="Remove section">
                <i class="fas fa-trash"></i>
            </button>
            <i class="fas fa-caret-down caret-icon"></i>
        </div>
    </h5>
    <p>Add information about your educational background. You can include multiple entries.</p>
    <div id="education" class="collapse show">
        @foreach ($EDForm->educations as $index => $education)
            <div class="form-row">
                <!-- Degree -->
                <div class="form-group col-md-4">
                    <label>Degree</label>
                    <input type="text"
                        class="form-control @error("EDForm.educations.{$index}.degree") is-invalid @enderror"
                        wire:model="EDForm.educations.{{ $index }}.degree"
                        placeholder="e.g., Bachelor's, Master's">
                    @error("EDForm.educations.{$index}.degree")
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Institution Name -->
                <div class="form-group col-md-4">
                    <label>Institution Name</label>
                    <input type="text"
                        class="form-control @error("EDForm.educations.{$index}.institution_name") is-invalid @enderror"
                        wire:model="EDForm.educations.{{ $index }}.institution_name"
                        placeholder="e.g., Harvard University">
                    @error("EDForm.educations.{$index}.institution_name")
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Location -->
                <div class="form-group col-md-4">
                    <label>Location</label>
                    <input type="text"
                        class="form-control @error("EDForm.educations.{$index}.location") is-invalid @enderror"
                        wire:model="EDForm.educations.{{ $index }}.location" placeholder="e.g., Cambridge, MA">
                    @error("EDForm.educations.{$index}.location")
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Graduation Date -->
                <div class="form-group col-md-4">
                    <label>Graduation Date</label>
                    <input type="date"
                        class="form-control @error("EDForm.educations.{$index}.graduation_date") is-invalid @enderror"
                        wire:model="EDForm.educations.{{ $index }}.graduation_date">
                    @error("EDForm.educations.{$index}.graduation_date")
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Certification Name -->
                <div class="form-group col-md-8">
                    <label>Certification Name</label>
                    <input type="text"
                        class="form-control @error("EDForm.educations.{$index}.certification_name") is-invalid @enderror"
                        wire:model="EDForm.educations.{{ $index }}.certification_name"
                        placeholder="e.g., AWS Certified Solutions Architect">
                    @error("EDForm.educations.{$index}.certification_name")
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

            </div>
            <!-- Description -->
            <div class="form-group flex-grow-1">
                <label>Description</label>
                <div class="d-flex">
                    <textarea class="form-control @error("EDForm.educations.{$index}.description") is-invalid @enderror"
                        wire:model="EDForm.educations.{{ $index }}.description"
                        placeholder="Include any relevant coursework, honors, or GPA if applicable" rows="3"></textarea>

                </div>
                @error("EDForm.educations.{$index}.description")
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            
        @endforeach
        <div class="d-flex justify-content-end align-items-center mt-0">
            <button type="button" class="btn btn-primary rounded" wire:click='addEducationRow'> Add
                Education </button>
            @if ($index > 0)
                <button type="button" class="btn btn-primary rounded ms-2"
                    wire:click="removeEducationRow({{ $index }})">
                    <i class="bi bi-trash-fill m-0 p-0"></i>
                </button>
            @endif
        </div>
    </div>
</section>
