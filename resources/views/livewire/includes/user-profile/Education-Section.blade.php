<div class="card mb-3 rounded">
    <div class="card-body">
        <div class="d-flex justify-content-between mb-3">
            <h5>Education</h5>
        </div>

        @forelse ($educations as $education)
            <ul class="list-unstyled">
                <div class="d-flex justify-content-between">
                    <li><strong>{{ $education->degree}} / {{$education->certification_name }}</strong></li>
                    <div class="d-flex justify-content-between align-items-center">
                        <strong class="">
                            {{ $education->graduation_date->format('M / Y') ?? 'Ongoing' }}
                        </strong>
                        <i class="bi bi-pencil-square py-0 px-1 ms-3 btn" data-bs-toggle="modal"
                            data-bs-target="#EditEducation"></i>
                    </div>
                </div>
                <li>{{ $education->institution_name }} | {{ $education->location }}</li>
                <li class="text-muted">{{ $education->description ?? 'No additional details provided' }}</li>
            </ul>
        @empty
            <p class="text-muted text-center py-3">
                No education to show
            </p>
        @endforelse
    </div>
</div>

<form wire:submit.prevent="saveEducation">

    <div class="modal fade overflow-hidden" id="EditEducation" tabindex="-1" role="dialog"
        aria-labelledby="modalTitleId" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">Edit a Education</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="educationContainer">
                        @foreach ($EDForm->educations as $index => $education)
                            <div class="form-group mb-3">

                                <div class="row">
                                    <!-- Degree -->
                                    <div class=" col-md-6">
                                        <label class="mb-2">Degree</label>
                                        <input type="text"
                                            class="form-control @error("EDForm.educations.{$index}.degree") is-invalid @enderror"
                                            wire:model="EDForm.educations.{{ $index }}.degree"
                                            placeholder="e.g., Bachelor's, Master's">
                                        @error("EDForm.educations.{$index}.degree")
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <!-- Institution Name -->
                                    <div class=" col-md-6">
                                        <label class="mb-2">Institution Name</label>
                                        <input type="text"
                                            class="form-control @error("EDForm.educations.{$index}.institution_name") is-invalid @enderror"
                                            wire:model="EDForm.educations.{{ $index }}.institution_name"
                                            placeholder="e.g., Harvard University">
                                        @error("EDForm.educations.{$index}.institution_name")
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <!-- Certification Name -->
                                <div class="mt-2 col-md-12">
                                    <label class="mb-2">Certification Name</label>
                                    <input type="text"
                                        class="form-control @error("EDForm.educations.{$index}.certification_name") is-invalid @enderror"
                                        wire:model="EDForm.educations.{{ $index }}.certification_name"
                                        placeholder="e.g., AWS Certified Solutions Architect">
                                    @error("EDForm.educations.{$index}.certification_name")
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="row mt-2">
                                    <!-- Graduation Date -->
                                    <div class=" col-md-6">
                                        <label class="mb-2">Graduation Date</label>
                                        <input type="date"
                                            class="form-control @error("EDForm.educations.{$index}.graduation_date") is-invalid @enderror"
                                            wire:model="EDForm.educations.{{ $index }}.graduation_date">
                                        @error("EDForm.educations.{$index}.graduation_date")
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <!-- Location -->
                                    <div class=" col-md-6">
                                        <label class="mb-2">Location</label>
                                        <input type="text"
                                            class="form-control @error("EDForm.educations.{$index}.location") is-invalid @enderror"
                                            wire:model="EDForm.educations.{{ $index }}.location"
                                            placeholder="e.g., Cambridge, MA">
                                        @error("EDForm.educations.{$index}.location")
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>


                                </div>

                                <!-- Description -->
                                <div class="mt-2 flex-grow-1">
                                    <label class="mb-2">Description</label>
                                    <div class="d-flex">
                                        <textarea class="form-control @error("EDForm.educations.{$index}.description") is-invalid @enderror"
                                            wire:model="EDForm.educations.{{ $index }}.description"
                                            placeholder="Include any relevant coursework, honors, or GPA if applicable" rows="3"></textarea>

                                    </div>
                                    @error("EDForm.educations.{$index}.description")
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
            let modalElement = document.getElementById('EditEducation');
            if (modalElement) {
                bootstrap.Modal.getOrCreateInstance(modalElement).hide();
            }
        });
    });
</script>
