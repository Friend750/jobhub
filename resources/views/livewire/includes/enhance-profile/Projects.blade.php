<section class="form-section rounded">
    <h5 data-toggle="collapse" data-target="#projects">
        {{ __('general.projects') }}
        <div class="d-flex align-items-center">
            <button class="btn text-muted btn-sm me-3 trash-button" type="button"
                x-on:click="toggleSection('projects')" title="{{ __('general.remove_section') }}">
                <i class="fas fa-trash"></i>
            </button>
            <i class="fas fa-caret-down caret-icon"></i>
        </div>
    </h5>
    <p>{{ __('general.projects_description') }}</p>
    <div id="projects" class="collapse show">
        <div id="projectsContainer">
            @foreach ($ProjectsForm->projects as $index => $project)
                <div class="project-block">
                    @if ($index > 0)
                        <hr>
                    @endif
                    <div class="row mb-3">
                        <div class="form-group mb-3 col-md-12">
                            <label class="mb-2" for="project_title_{{ $index }}">{{ __('general.project_title') }}</label>
                            <input type="text"
                                class="form-control @error("ProjectsForm.projects.{$index}.title") is-invalid @enderror"
                                wire:model="ProjectsForm.projects.{{ $index }}.title"
                                placeholder="{{ __('general.placeholder_project_title') }}">
                            @error("ProjectsForm.projects.{$index}.title")
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group mb-3 col-md-12">
                            <label class="mb-2" for="project_description_{{ $index }}">{{ __('general.project_description') }}</label>
                            <textarea class="form-control @error("ProjectsForm.projects.{$index}.description") is-invalid @enderror"
                                wire:model="ProjectsForm.projects.{{ $index }}.description"
                                placeholder="{{ __('general.placeholder_project_description') }}" rows="3"></textarea>
                            @error("ProjectsForm.projects.{$index}.description")
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group mb-3 col-md-12">
                            <label class="mb-2" for="project_contributions_{{ $index }}">{{ __('general.project_contributions') }}</label>
                            <textarea class="form-control @error("ProjectsForm.projects.{$index}.contributions") is-invalid @enderror"
                                wire:model="ProjectsForm.projects.{{ $index }}.contributions"
                                placeholder="{{ __('general.placeholder_project_contributions') }}" rows="2"></textarea>
                            @error("ProjectsForm.projects.{$index}.contributions")
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-end align-items-center mt-0">
            <button type="button" class="btn btn-primary rounded" wire:click="addProject">
                {{ __('general.add_project') }}
            </button>
            @if ($index > 0)
                <i class="bi bi-trash-fill btn btn-primary rounded ms-2"
                    wire:click="removeProject({{ $index }})" title="{{ __('general.remove_project') }}"></i>
            @endif
        </div>
    </div>
</section>
