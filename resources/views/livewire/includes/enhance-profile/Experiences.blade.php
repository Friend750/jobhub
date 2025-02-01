<section class="form-section rounded">
    <h5 data-toggle="collapse" data-target="#Experience">
        Experiences
        <div class="d-flex align-items-center">
            <button class="btn text-muted btn-sm me-3 trash-button" type="button"
                x-on:click="toggleSection('experiences')" title="Remove section">
                <i class="fas fa-trash"></i>
            </button>

            <i class="fas fa-caret-down caret-icon"></i>
        </div>
    </h5>
    <p>Add details about your previous work experience. You can include multiple positions.</p>
    <div id="Experience" class="collapse show">
        <div id="ExperienceContainer">
            @foreach ($ExperienceForm->experiences as $index => $experience)
                <div class="experiences-block mb-4">
                    @if ($index > 0)
                        <hr>
                    @endif
                    <div class="row mb-3">
                        <div class="form-group col-md-6">
                            <label class="mb-2" for="job_title_{{ $index }}">Job Title</label>
                            <input type="text"
                                class="form-control @error("ExperienceForm.experiences.{$index}.job_title") is-invalid @enderror"
                                wire:model="ExperienceForm.experiences.{{ $index }}.job_title"
                                placeholder="e.g., Software Engineer">
                            @error("ExperienceForm.experiences.{$index}.job_title")
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="mb-2" for="company_name_{{ $index }}">Company Name</label>
                            <input type="text"
                                class="form-control @error("ExperienceForm.experiences.{$index}.company_name") is-invalid @enderror"
                                wire:model="ExperienceForm.experiences.{{ $index }}.company_name"
                                placeholder="e.g., ABC Corp">
                            @error("ExperienceForm.experiences.{$index}.company_name")
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="form-group col-md-3">
                            <label class="mb-2" for="start_date_{{ $index }}">Start Date</label>
                            <input type="date"
                                class="form-control @error("ExperienceForm.experiences.{$index}.start_date") is-invalid @enderror"
                                wire:model="ExperienceForm.experiences.{{ $index }}.start_date">
                            @error("ExperienceForm.experiences.{$index}.start_date")
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group col-md-3">
                            <label class="mb-2" for="end_date_{{ $index }}">End Date</label>
                            <input type="date"
                                class="form-control @error("ExperienceForm.experiences.{$index}.end_date") is-invalid @enderror"
                                wire:model="ExperienceForm.experiences.{{ $index }}.end_date">
                            @error("ExperienceForm.experiences.{$index}.end_date")
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="mb-2" for="location_{{ $index }}">Location</label>
                            <input type="text"
                                class="form-control @error("ExperienceForm.experiences.{$index}.location") is-invalid @enderror"
                                wire:model="ExperienceForm.experiences.{{ $index }}.location"
                                placeholder="e.g., New York">
                            @error("ExperienceForm.experiences.{$index}.location")
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="mb-2" for="description_{{ $index }}">Description</label>
                        <textarea class="form-control @error("ExperienceForm.experiences.{$index}.description") is-invalid @enderror"
                            wire:model="ExperienceForm.experiences.{{ $index }}.description" rows="3"
                            placeholder="What has been done at this position?"></textarea>
                        @error("ExperienceForm.experiences.{$index}.description")
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-end align-items-center mt-0">
            <button type="button" class="btn btn-primary rounded" wire:click="addExperience">Add Experience</button>
            @if ($index > 0)
                <i class="bi bi-trash-fill btn btn-primary rounded ms-2"
                    wire:click="removeExperience({{ $index }})"></i>
            @endif
        </div>

    </div>
</section>
