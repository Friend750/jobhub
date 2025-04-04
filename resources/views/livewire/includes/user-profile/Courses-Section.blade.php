<div class="card mb-3 rounded" x-data="coursesForm(@this)">
    <div class="card-body">
        <div class="d-flex justify-content-between mb-3">
            <h5>الشهادات | الدورات</h5>
        </div>

        @forelse ($courses as $course)
            <ul class="list-unstyled">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="left" x-data="{ expanded: false }">
                        <div class="d-flex justify-content-between">
                            <li><strong>{{ $course->course_name }} | {{ $course->institution_name }}</strong></li>
                        </div>
                        <ul class="me-4">
                            <!-- Completion Date Section -->
                            <li class="text-muted">
                                <strong>تاريخ الانتهاء: </strong>
                                <span>{{ $course->end_date ? $course->end_date->format('M - Y') : 'Ongoing' }}</span>
                            </li>

                        </ul>
                    </div>

                    @if (auth()->user()->id === $user->id)

                        <!-- Edit Icon -->
                        <div class="right-icon">
                            <i class="bi bi-pencil-square py-0 px-1 me-3 btn" data-bs-toggle="modal"
                                data-bs-target="#EditCourses" x-on:click="oldData({{ $course->id }})"></i>
                        </div>
                    @endif
                </div>
            </ul>
        @empty
            <p class="text-muted text-center py-3">لم يتم العثور على شهادات أو دورات.</p>
        @endforelse
    </div>

    <!-- Modal for Editing Courses -->
    <form wire:submit.prevent="saveCourse">
        <div class="modal fade overflow-hidden" id="EditCourses" tabindex="-1" role="dialog"
            aria-labelledby="modalTitleId" aria-hidden="true" wire:ignore.self>
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitleId">تعديل الدورة</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="coursesContainer">
                            @foreach ($CoursesForm->courses as $index => $course)
                                <div class="course-block">
                                    @if ($index > 0)
                                        <hr>
                                    @endif
                                    <div class="row">
                                        <div class="form-group col-md-12 mb-3">
                                            <label class="mb-2" for="course_name_{{ $index }}">اسم الدورة</label>
                                            <input type="text"
                                                class="form-control @error("CoursesForm.courses.{$index}.course_name") is-invalid @enderror"
                                                wire:model="CoursesForm.courses.{{ $index }}.course_name"
                                                placeholder="e.g., Data Science Bootcamp">
                                            @error("CoursesForm.courses.{$index}.course_name")
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-12 mb-3">
                                            <label class="mb-2" for="institution_name_{{ $index }}">
                                                اسم المؤسسة</label>
                                            <input type="text"
                                                class="form-control @error("CoursesForm.courses.{$index}.institution_name") is-invalid @enderror"
                                                wire:model="CoursesForm.courses.{{ $index }}.institution_name"
                                                placeholder="e.g., Coursera, Udemy">
                                            @error("CoursesForm.courses.{$index}.institution_name")
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-12 mb-3">
                                            <label class="mb-2" for="end_date_{{ $index }}">تاريخ الانتهاء</label>
                                            <input type="date"
                                                class="form-control @error("CoursesForm.courses.{$index}.end_date") is-invalid @enderror"
                                                wire:model="CoursesForm.courses.{{ $index }}.end_date"
                                                placeholder="MM / YYYY">
                                            @error("CoursesForm.courses.{$index}.end_date")
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn rounded btn-dark" style="min-width: 40px;"
                            x-on:click="removeCourse()" wire:loading.attr='disabled'><i
                                class="fas fa-trash"></i></button>
                        <button type="submit" class="btn rounded btn-primary" wire:loading.attr='disabled'>حفظ
                            التغييرات</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

{{-- CourseMsg --}}
@if (session('CourseMsg'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('CourseMsg') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<script>
    document.addEventListener('DOMContentLoaded', function () {
        Livewire.on('close-modal', () => {
            let modalElement = document.getElementById('EditCourses');
            if (modalElement) {
                bootstrap.Modal.getOrCreateInstance(modalElement).hide();
            }
        });
    });

    function coursesForm($wire) {
        return {
            courseId: null,
            oldData(id) {
                this.courseId = id; // Set the courseId
                $wire.getOldCourse(id); // Call Livewire method with the ID
            },
            removeCourse() {
                $wire.deleteCourse(); // Call Livewire method with the ID
                // Hide modal
                let modalElement = document.getElementById('EditCourses');
                if (modalElement) {
                    bootstrap.Modal.getOrCreateInstance(modalElement).hide();
                }
            }
        }
    }
</script>
