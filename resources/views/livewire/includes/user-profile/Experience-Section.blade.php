<div class="card mb-3 rounded">
    <div class="card-body">
        <div class="d-flex justify-content-between mb-3">
            <h5>Experience</h5>
        </div>

        <ul class="list-unstyled">
            @forelse ($experiences as $experience)
                <li class="border-bottom py-2">
                    <div class="d-flex justify-content-between align-items-center">
                        <strong>{{ $experience->job_title }} | {{ $experience->company_name }} | {{ $experience->location }}</strong>
                        <div class="d-flex align-items-center">
                            <strong class="">
                                {{ $experience->start_date->format('M Y') }} –
                                {{ $experience->end_date->format('M Y') ?? 'Present' }}
                            </strong>
                            <i class="bi bi-pencil-square py-0 px-1 ms-3 btn" data-bs-toggle="modal"
                                data-bs-target="#EditExperience{{ $experience->id }}"></i>
                        </div>
                    </div>
                    <p class="text-muted mt-1">{{ $experience->description ?? 'No description provided' }}</p>
                </li>
            @empty
                <li class="text-muted text-center py-3">No job experience added yet.</li>
            @endforelse

        </ul>
    </div>
</div>

<form wire:submit.prevent ="saveExperience">
    <!-- Modal EditExperience -->
    <div class="modal fade overflow-hidden" id="EditExperience" tabindex="-1" aria-labelledby="modalTitleId"
        aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">Edit Experience</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
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
                                        <label class="mb-2" for="company_name_{{ $index }}">Company
                                            Name</label>
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
                                    <div class="form-group col-md-6">
                                        <label class="mb-2" for="start_date_{{ $index }}">Start Date</label>
                                        <input type="date"
                                            class="form-control @error("ExperienceForm.experiences.{$index}.start_date") is-invalid @enderror"
                                            wire:model="ExperienceForm.experiences.{{ $index }}.start_date">
                                        @error("ExperienceForm.experiences.{$index}.start_date")
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="mb-2" for="end_date_{{ $index }}">End Date</label>
                                        <input type="date"
                                            class="form-control @error("ExperienceForm.experiences.{$index}.end_date") is-invalid @enderror"
                                            wire:model="ExperienceForm.experiences.{{ $index }}.end_date">
                                        @error("ExperienceForm.experiences.{$index}.end_date")
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-12">
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
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
</form>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        Livewire.on('close-modal', () => {
            let modalElement = document.getElementById('EditExperience');
            if (modalElement) {
                bootstrap.Modal.getOrCreateInstance(modalElement).hide();
            }
        });
    });
</script>
