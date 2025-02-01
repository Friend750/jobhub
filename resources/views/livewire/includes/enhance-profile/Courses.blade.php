<div class="form-section rounded">
    <h5 data-toggle="collapse" data-target="#courses">
        {{ __('general.courses') }}
        <div class="d-flex align-items-center">
            <button class="btn text-muted btn-sm me-3 trash-button" type="button"
                x-on:click="toggleSection('courses')" title="{{ __('general.remove_section') }}">
                <i class="fas fa-trash"></i>
            </button>
            <i class="fas fa-caret-down caret-icon"></i>
        </div>
    </h5>
    <p>{{ __('general.courses_description') }}</p>
    <div id="courses" class="collapse show">
        <div id="coursesContainer">
            @foreach ($CoursesForm->courses as $index => $course)
                <div class="row mb-3">
                    <div class="form-group col-md-4">
                        <label for="course_name_{{ $index }}" style="min-width: 150px;">{{ __('general.course_name') }}</label>
                        <input type="text"
                            class="form-control @error("CoursesForm.courses.{$index}.course_name") is-invalid @enderror"
                            id="course_name_{{ $index }}"
                            wire:model="CoursesForm.courses.{{ $index }}.course_name"
                            placeholder="{{ __('general.placeholder_course_name') }}">
                        @error("CoursesForm.courses.{$index}.course_name")
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label for="institution_name_{{ $index }}" style="min-width: 150px;">{{ __('general.institution_name') }}</label>
                        <input type="text"
                            class="form-control @error("CoursesForm.courses.{$index}.institution_name") is-invalid @enderror"
                            id="institution_name_{{ $index }}"
                            wire:model="CoursesForm.courses.{{ $index }}.institution_name"
                            placeholder="{{ __('general.placeholder_institution') }}">
                        @error("CoursesForm.courses.{$index}.institution_name")
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label for="end_date_{{ $index }}" style="min-width: 150px;">{{ __('general.completion_date') }}</label>
                        <input type="date"
                            class="form-control @error("CoursesForm.courses.{$index}.end_date") is-invalid @enderror"
                            id="end_date_{{ $index }}"
                            wire:model="CoursesForm.courses.{{ $index }}.end_date"
                            placeholder="{{ __('general.placeholder_completion_date') }}"
                            title="{{ __('general.title_completion_date') }}">
                        @error("CoursesForm.courses.{$index}.end_date")
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-end align-items-center mt-0">
            <button type="button" class="btn btn-primary rounded" wire:click="addCourseRow">
                {{ __('general.add_course') }}
            </button>
            @if ($index > 0)
            <i class="bi bi-trash-fill btn btn-primary rounded ms-2"
                wire:click="removeCourseRow({{ $index }})" title="{{ __('general.remove_course') }}"></i>
            @endif
        </div>
    </div>
</div>
