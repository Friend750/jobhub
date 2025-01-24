<section class="form-section rounded">
    <h5 data-toggle="collapse" data-target="#projects">
        Projects
        <div class="d-flex align-items-center">
            <button class="btn text-muted btn-sm me-3 trash-button" type="button" x-on:click="toggleSection('projects')"
                title="Remove section">
                <i class="fas fa-trash"></i>
            </button>

            <i class="fas fa-caret-down caret-icon"></i>
        </div>
    </h5>
    <p>List your projects, their descriptions, and key outcomes or contributions.</p>
    <div id="projects" class="collapse show">
        <div id="projectsContainer">
            @foreach ($ProjectsForm->projects as $index => $project)

                <div class="project-block">
                    @if ($index > 0)
                        <hr>
                    @endif
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="project_title_{{ $index }}">Project Title</label>
                            <input type="text"
                                class="form-control @error("ProjectsForm.projects.{$index}.title") is-invalid @enderror"
                                wire:model="ProjectsForm.projects.{{ $index }}.title"
                                placeholder="Enter Project Title">
                            @error("ProjectsForm.projects.{$index}.title")
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group col-md-12">
                            <label for="project_description_{{ $index }}">Project Description</label>
                            <textarea class="form-control @error("ProjectsForm.projects.{$index}.description") is-invalid @enderror"
                                wire:model="ProjectsForm.projects.{{ $index }}.description"
                                placeholder="Description of the project, including tools and technologies used" rows="3"></textarea>
                            @error("ProjectsForm.projects.{$index}.description")
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group col-md-12">
                            <label for="project_contributions_{{ $index }}">Key Outcomes/Contributions</label>
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
        <div class="d-flex justify-content-end align-items-center mt-3">
            <button type="button" class="btn btn-primary rounded" wire:click="addProject">Add Project</button>
            @if ($index > 0)
                <i class="bi bi-trash-fill btn btn-primary rounded ms-2"
                    wire:click="removeProject({{ $index }})"></i>
            @endif
        </div>
    </div>
</section>
