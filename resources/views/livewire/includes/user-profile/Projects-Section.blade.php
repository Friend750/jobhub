<div class="card mb-3 rounded" x-data="projectsForm(@this)">
    <div class="card-body">
        <div class="d-flex justify-content-between mb-3">
            <h5>المشاريع</h5>
        </div>


        @forelse ($projects as $project)
            <ul class="list-unstyled">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="left" x-data="{ expanded: false }">
                        <div class="d-flex justify-content-between">
                            <li><strong>{{ $project->title }}</strong></li>
                        </div>
                        <ul class="me-4">
                            <!-- Description Section -->
                            <li class="text-muted">
                                <strong>الوصف: </strong>
                                <span
                                    x-show="!expanded">{{ \Illuminate\Support\Str::limit($project->description, 200, '...') }}</span>
                                <span x-show="expanded" x-cloak>{{ $project->description }}</span>
                            </li>

                            <!-- Contributions Section -->
                            <li class="text-muted" x-show="expanded" x-cloak>
                                <strong>المساهمات: </strong>
                                <span>{{ $project->contributions }}</span>
                            </li>

                            <!-- Read More / Read Less Button -->
                            @if (strlen($project->description) > 200 || strlen($project->contributions) > 200)
                                <button class="btn text-muted fw-bolder p-0" @click="expanded = !expanded"
                                    x-text="expanded ? 'اعرض اقل' : 'اعرض اكثر'"></button>
                            @endif
                        </ul>
                    </div>


                    <div class="right-icon">
                        @if (auth()->user()->id === $user->id)
                            <i class="bi bi-pencil-square py-0 px-1 me-3 btn" data-bs-toggle="modal"
                                data-bs-target="#EditProjects" x-on:click="oldData({{ $project->id }})"></i>
                        @endif

                    </div>
                </div>
            </ul>
        @empty
            <p class="text-muted text-center py-3">لم يتم الاضافة بعد.</p>
        @endforelse

    </div>
    <!-- modal EditProjects -->
    <form wire:submit.prevent="saveProject">

        <div class="modal fade overflow-hidden" id="EditProjects" tabindex="-1" role="dialog"
            aria-labelledby="modalTitleId" aria-hidden="true" wire:ignore.self>
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitleId">التعديل على مشروع</h5>
                        {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"></span>
                        </button> --}}
                    </div>
                    <div class="modal-body">
                        <div id="projectsContainer">
                            @foreach ($ProjectsForm->projects as $index => $project)
                                <div class="project-block">
                                    @if ($index > 0)
                                        <hr>
                                    @endif
                                    <div class="row">
                                        <div class="form-group col-md-12 mb-3">
                                            <label class="mb-2" for="project_title_{{ $index }}">اسم المشروع</label>
                                            <input type="text"
                                                class="form-control @error("ProjectsForm.projects.{$index}.title") is-invalid @enderror"
                                                wire:model="ProjectsForm.projects.{{ $index }}.title"
                                                placeholder="Enter Project Title">
                                            @error("ProjectsForm.projects.{$index}.title")
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-12 mb-3">
                                            <label class="mb-2" for="project_description_{{ $index }}">وصف المشروع</label>
                                            <textarea
                                                class="form-control @error("ProjectsForm.projects.{$index}.description") is-invalid @enderror"
                                                wire:model="ProjectsForm.projects.{{ $index }}.description"
                                                placeholder="Description of the project, including tools and technologies used"
                                                rows="3"></textarea>
                                            @error("ProjectsForm.projects.{$index}.description")
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-12 mb-3">
                                            <label class="mb-2" for="project_contributions_{{ $index }}">اهم المخرجات او
                                                المساهمات</label>
                                            <textarea
                                                class="form-control @error("ProjectsForm.projects.{$index}.contributions") is-invalid @enderror"
                                                wire:model="ProjectsForm.projects.{{ $index }}.contributions"
                                                placeholder="Key outcomes or contributions made during the project"
                                                rows="2"></textarea>
                                            @error("ProjectsForm.projects.{$index}.contributions")
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
                            x-on:click="removeProject()" wire:loading.attr='disabled'><i
                                class="fas fa-trash"></i></button>
                        <button type="submit" class="btn rounded btn-primary" wire:loading.attr='disabled'>حفظ
                            التغييرات</button>
                    </div>
                </div>
            </div>
        </div>

    </form>

</div>
{{-- ProjectMsg --}}

@if (session('ProjectMsg'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('ProjectMsg') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<script>
    document.addEventListener('DOMContentLoaded', function () {
        Livewire.on('close-modal', () => {
            let modalElement = document.getElementById('EditProjects');
            if (modalElement) {
                bootstrap.Modal.getOrCreateInstance(modalElement).hide();
            }
        });
    });

    function projectsForm($wire) {
        return {
            projectId: null,
            oldData(id) {
                this.projectId = id; // Set the projectId
                $wire.getOldPro(id); // Call Livewire method with the ID
            },
            removeProject() {
                $wire.deletePro(); // Call Livewire method with the ID
                // hide modal
                let modalElement = document.getElementById('EditProjects');
                if (modalElement) {
                    bootstrap.Modal.getOrCreateInstance(modalElement).hide();
                }
            }
        }
    }
</script>
