<div class="card mb-3 rounded">
    <div class="card-body">
        <div class="d-flex justify-content-between mb-3">
            <h5>Projects</h5>
        </div>


        <ul class="list-unstyled">
            <div class="d-flex justify-content-between align-items-center">
                <div class="left">
                    <div class="d-flex justify-content-between">
                        <li><strong>Project Title</strong></li>
                    </div>
                    <ul>

                        <li>[Description of the project, including tools and technologies used]</li>
                        <li>[Key outcomes or contributions made during the project]</li>

                    </ul>

                </div>

                <div class="right-icon">
                    <i class="bi bi-pencil-square  py-0 px-1 ms-3 btn" data-bs-toggle="modal"
                        data-bs-target="#EditProjects"></i>
                </div>
            </div>
        </ul>
        <ul class="list-unstyled">
            <div class="d-flex justify-content-between align-items-center">
                <div class="left">
                    <div class="d-flex justify-content-between">
                        <li><strong>Project Title</strong></li>
                    </div>
                    <ul>

                        <li>[Description of the project, including tools and technologies used]</li>
                        <li>[Key outcomes or contributions made during the project]</li>

                    </ul>

                </div>

                <div class="right-icon">
                    <i class="bi bi-pencil-square  py-0 px-1 ms-3 btn" data-bs-toggle="modal"
                        data-bs-target="#EditProjects"></i>

                </div>
            </div>
        </ul>

    </div>
</div>

<!-- modal EditProjects -->
<form wire:submit.prevent="saveProject">

    <div class="modal fade overflow-hidden" id="EditProjects" tabindex="-1" role="dialog"
        aria-labelledby="modalTitleId" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">Edit a Project</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"></span>
                    </button>
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
                                        <label class="mb-2" for="project_title_{{ $index }}">Project
                                            Title</label>
                                        <input type="text"
                                            class="form-control @error("ProjectsForm.projects.{$index}.title") is-invalid @enderror"
                                            wire:model="ProjectsForm.projects.{{ $index }}.title"
                                            placeholder="Enter Project Title">
                                        @error("ProjectsForm.projects.{$index}.title")
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-12 mb-3">
                                        <label class="mb-2" for="project_description_{{ $index }}">Project
                                            Description</label>
                                        <textarea class="form-control @error("ProjectsForm.projects.{$index}.description") is-invalid @enderror"
                                            wire:model="ProjectsForm.projects.{{ $index }}.description"
                                            placeholder="Description of the project, including tools and technologies used" rows="3"></textarea>
                                        @error("ProjectsForm.projects.{$index}.description")
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-12 mb-3">
                                        <label class="mb-2" for="project_contributions_{{ $index }}">Key
                                            Outcomes/Contributions</label>
                                        <textarea class="form-control @error("ProjectsForm.projects.{$index}.contributions") is-invalid @enderror"
                                            wire:model="ProjectsForm.projects.{{ $index }}.contributions"
                                            placeholder="Key outcomes or contributions made during the project" rows="2"></textarea>
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
            let modalElement = document.getElementById('EditProjects');
            if (modalElement) {
                bootstrap.Modal.getOrCreateInstance(modalElement).hide();
            }
        });
    });
</script>
