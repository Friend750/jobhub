<div class="card mb-3 rounded" x-data="educationForm(@this)">
    <div class="card-body">
        <div class="d-flex justify-content-between mb-3">
            <h5>Education</h5>
        </div>

        @forelse ($educations as $education)
            <ul class="list-unstyled">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="left" x-data="{ expanded: false }">
                        <div class="d-flex justify-content-between">
                            <li><strong>{{ $education->degree }} / {{ $education->certification_name }}</strong></li>
                        </div>
                        <ul class="me-4">
                            <!-- Institution and Location Section -->
                            <li class="text-muted">
                                <strong>Institution: </strong>
                                <span>{{ $education->institution_name }} | {{ $education->location }}</span>
                            </li>

                            <!-- Description Section -->
                            <li class="text-muted">
                                <strong>Description: </strong>
                                <span
                                    x-show="!expanded">{{ \Illuminate\Support\Str::limit($education->description, 200, '...') }}</span>
                                <span x-show="expanded" x-cloak>{{ $education->description }}</span>
                            </li>

                            <!-- Graduation Date Section -->
                            <li class="text-muted" x-show="expanded" x-cloak>
                                <strong>Graduation Date: </strong>
                                <span>{{ $education->graduation_date->format('M / Y') ?? 'Ongoing' }}</span>
                            </li>

                            <!-- Read More / Read Less Button -->
                            @if (strlen($education->description) > 200)
                                <button class="btn text-muted fw-bolder p-0" @click="expanded = !expanded"
                                    x-text="expanded ? 'Read Less' : 'Read More'"></button>
                            @endif
                        </ul>
                    </div>

                    <div class="right-icon">
                        <i class="bi bi-pencil-square py-0 px-1 ms-3 btn" data-bs-toggle="modal"
                            data-bs-target="#EditEducation" x-on:click="oldData({{ $education->id }})"></i>
                    </div>
                </div>
            </ul>
        @empty
            <p class="text-muted text-center py-3">No education to show.</p>
        @endforelse
    </div>

    <!-- modal EditEducation -->
    <form wire:submit.prevent="saveEducation">
        <div class="modal fade overflow-hidden" id="EditEducation" tabindex="-1" role="dialog"
            aria-labelledby="modalTitleId" aria-hidden="true" wire:ignore.self>
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitleId">Edit Education</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="educationContainer">
                            @foreach ($EDForm->educations as $index => $education)
                                <div class="education-block">
                                    @if ($index > 0)
                                        <hr>
                                    @endif
                                    <div class="row">
                                        <!-- Degree -->
                                        <div class="form-group col-md-6 mb-3">
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
                                        <div class="form-group col-md-6 mb-3">
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
                                    <div class="form-group col-md-12 mb-3">
                                        <label class="mb-2">Certification Name</label>
                                        <input type="text"
                                            class="form-control @error("EDForm.educations.{$index}.certification_name") is-invalid @enderror"
                                            wire:model="EDForm.educations.{{ $index }}.certification_name"
                                            placeholder="e.g., AWS Certified Solutions Architect">
                                        @error("EDForm.educations.{$index}.certification_name")
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="row">
                                        <!-- Graduation Date -->
                                        <div class="form-group col-md-6 mb-3">
                                            <label class="mb-2">Graduation Date</label>
                                            <input type="date"
                                                class="form-control @error("EDForm.educations.{$index}.graduation_date") is-invalid @enderror"
                                                wire:model="EDForm.educations.{{ $index }}.graduation_date">
                                            @error("EDForm.educations.{$index}.graduation_date")
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <!-- Location -->
                                        <div class="form-group col-md-6 mb-3">
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
                                    <div class="form-group col-md-12 mb-3">
                                        <label class="mb-2">Description</label>
                                        <textarea class="form-control @error("EDForm.educations.{$index}.description") is-invalid @enderror"
                                            wire:model="EDForm.educations.{{ $index }}.description"
                                            placeholder="Include any relevant coursework, honors, or GPA if applicable" rows="3"></textarea>
                                        @error("EDForm.educations.{$index}.description")
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn rounded btn-dark" style="min-width: 40px;"
                            x-on:click="removeEducation()" wire:loading.attr='disabled'><i
                                class="fas fa-trash"></i></button>
                        <button type="submit" class="btn rounded btn-primary" wire:loading.attr='disabled'>Save
                            changes</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

{{-- EducationMsg --}}
@if (session('EducationMsg'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('EducationMsg') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<script>
    document.addEventListener('DOMContentLoaded', function() {
        Livewire.on('close-modal', () => {
            let modalElement = document.getElementById('EditEducation');
            if (modalElement) {
                bootstrap.Modal.getOrCreateInstance(modalElement).hide();
            }
        });
    });

    function educationForm($wire) {
        return {
            educationId: null,
            oldData(id) {
                this.educationId = id; // Set the educationId
                $wire.getOldEdu(id); // Call Livewire method with the ID
            },
            removeEducation() {
                $wire.deleteEdu(); // Call Livewire method with the ID
                // hide modal
                let modalElement = document.getElementById('EditEducation');
                if (modalElement) {
                    bootstrap.Modal.getOrCreateInstance(modalElement).hide();
                }
            }
        }
    }
</script>
