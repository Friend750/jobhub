<div class="form-section rounded">
    <h5 data-toggle="collapse" data-target="#courses">
        Courses
        <div class="d-flex align-items-center">
            <button class="btn text-muted btn-sm me-3 trash-button" type="button" x-on:click="toggleSection('courses')"
                title="Remove section">
                <i class="fas fa-trash"></i>
            </button>

            <i class="fas fa-caret-down caret-icon"></i>
        </div>
    </h5>
    <p>List any certifications or additional training programs you have completed that are relevant to the
        position.</p>
    <div id="courses" class="collapse show">
        <div id="coursesContainer">
            @foreach ($CoursesForm->courses as $index => $course)
                <div class="row mb-3">
                    <div class="form-group col-md-4">
                        <label class="mb-2" for="course_name_{{ $index }}" style="min-width: 150px;">Course Name</label>
                        <input type="text"
                            class="form-control @error("CoursesForm.courses.{$index}.course_name") is-invalid @enderror"
                            id="course_name_{{ $index }}"
                            wire:model="CoursesForm.courses.{{ $index }}.course_name"
                            placeholder="e.g., Data Science Bootcamp">
                        @error("CoursesForm.courses.{$index}.course_name")
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label class="mb-2" for="institution_name_{{ $index }}" style="min-width: 150px;">Institution
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
                    <div class="form-group col-md-4">
                        <label class="mb-2" for="end_date_{{ $index }}" style="min-width: 150px;">Completion Date</label>
                        <input type="date"
                            class="form-control @error("CoursesForm.courses.{$index}.end_date") is-invalid @enderror"
                            id="end_date_{{ $index }}"
                            wire:model="CoursesForm.courses.{{ $index }}.end_date" placeholder="MM / YYYY"
                            title="Enter the completion date">
                        @error("CoursesForm.courses.{$index}.end_date")
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-end align-items-center mt-0">
            <button type="button" class="btn btn-primary rounded" wire:click="addCourseRow">Add Course</button>
            @if ($index > 0)
            <i class="bi bi-trash-fill btn btn-primary rounded ms-2"
                wire:click="removeCourseRow({{ $index }})"></i>
            @endif
        </div>
    </div>
</div>
