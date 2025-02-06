<div class="card mb-3 rounded">
    <div class="card-body">
        <div class="d-flex justify-content-between mb-3">
            <h5>Certifications | Courses</h5>
        </div>


        @forelse ($courses as $course)
            <ul class="list-unstyled">
                <div class="d-flex justify-content-between">
                    <li><strong>{{ $course->course_name }} | {{ $course->institution_name }}</strong></li>
                    <div class="d-flex justify-content-between align-items-center">
                        <strong class="">
                            {{ $course->end_date ? $course->end_date->format('M - Y') : 'Ongoing' }}
                        </strong>
                        <i class="bi bi-pencil-square py-0 px-1 ms-3 btn" data-bs-toggle="modal"
                            data-bs-target="#EditCourses"></i>
                    </div>
                </div>
            </ul>
        @empty
            <p class="text-muted text-center py-3">
                No Certifications | Courses to show
            </p>
        @endforelse

    </div>
</div>


<!-- modal EditCourses -->
<form wire:submit.prevent="saveCourse">

    <div class="modal fade overflow-hidden" id="EditCourses" tabindex="-1" role="dialog"
        aria-labelledby="modalTitleId" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">Edit a Course</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="coursesContainer">
                        @foreach ($CoursesForm->courses as $index => $course)
                            <div class="row mb-3">
                                <div class="form-group col-md-12 mb-2">
                                    <label class="mb-2" for="course_name_{{ $index }}"
                                        style="min-width: 150px;">Course Name</label>
                                    <input type="text"
                                        class="form-control @error("CoursesForm.courses.{$index}.course_name") is-invalid @enderror"
                                        id="course_name_{{ $index }}"
                                        wire:model="CoursesForm.courses.{{ $index }}.course_name"
                                        placeholder="e.g., data-bs Science Bootcamp">
                                    @error("CoursesForm.courses.{$index}.course_name")
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="mb-2" for="institution_name_{{ $index }}"
                                        style="min-width: 150px;">Institution
                                        Name</label>
                                    <input type="text"
                                        class="form-control @error("CoursesForm.courses.{$index}.institution_name") is-invalid @enderror"
                                        id="institution_name_{{ $index }}"
                                        wire:model="CoursesForm.courses.{{ $index }}.institution_name"
                                        placeholder="e.g., Coursera, Udemy">
                                    @error("CoursesForm.courses.{$index}.institution_name")
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="mb-2" for="end_date_{{ $index }}"
                                        style="min-width: 150px;">Completion Date</label>
                                    <input type="date"
                                        class="form-control @error("CoursesForm.courses.{$index}.end_date") is-invalid @enderror"
                                        id="end_date_{{ $index }}"
                                        wire:model="CoursesForm.courses.{{ $index }}.end_date"
                                        placeholder="MM / YYYY" title="Enter the completion date">
                                    @error("CoursesForm.courses.{$index}.end_date")
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
            let modalElement = document.getElementById('EditCourses');
            if (modalElement) {
                bootstrap.Modal.getOrCreateInstance(modalElement).hide();
            }
        });
    });
</script>
